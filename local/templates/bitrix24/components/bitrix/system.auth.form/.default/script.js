BX.namespace("BX.Bitrix24.Helper");

BX.Bitrix24.Helper =
{
	frameOpenUrl : '',
	frameCloseUrl : '',
	isOpen : false,
	frameNode : null,
	popupNodeWrap : null,
	curtainNode : null,
	popupNode : null,
	closeBtn : null,
	openBtn : null,
	popupLoader : null,
	topBar : null,
	topBarHtml : null,
	header : null,
	langId: null,
	reloadPath: null,
	ajaxUrl: '',
	currentStepId: '',
	notifyBlock : null,
	notifyNum: '',
	notifyText: '',
	notifyId: 0,
	notifyButton: '',

	init : function (params)
	{
		this.frameOpenUrl = params.frameOpenUrl || '';
		this.frameCloseUrl = params.frameCloseUrl || '';
		this.helpUpBtnText = params.helpUpBtnText || '';
		this.langId = params.langId || '';
		this.openBtn = params.helpBtn;
		this.notifyBlock = params.notifyBlock;
		this.reloadPath = params.reloadPath || '';
		this.ajaxUrl = params.ajaxUrl || '';
		this.currentStepId = params.currentStepId || '';
		this.notifyData = params.notifyData || null;
		this.runtimeUrl = params.runtimeUrl || null;
		this.notifyUrl = params.notifyUrl || '';
		this.helpUrl = params.helpUrl || '';
		this.notifyNum = params.notifyNum || '';

		this.popupLoader = BX.create('div',{
			attrs:{className:'bx-help-popup-loader'},
			children : [BX.create('div', {
				attrs:{className:'bx-help-popup-loader-text'},
				text : BX.message("B24_HELP_LOADER")
			})]
		});

		this.topBarHtml = '<div class="bx-help-menu-title" onclick="BX.Bitrix24.Helper.reloadFrame(\'' + this.reloadPath + '\')">'+BX.message("B24_HELP_TITLE")+'<span class="bx-help-blue">24</span></div>';

		this.topBar = BX.create('div',{
			attrs:{className:'bx-help-nav-wrap'},
			html : this.topBarHtml
		})

		this.header = BX('header');

		this.createFrame();
		this.createCloseBtn();
		this.createPopup();

		BX.bind(this.openBtn, 'click', BX.proxy(this.show, this));
		BX.bind(this.openBtn, 'click', BX.proxy(this.setBlueHeroView, this));

		BX.bind(window, 'message', BX.proxy(function(event)
		{
			event = event || window.event;
			if(typeof(event.data.action) == "undefined")
			{
				if(event.data.height && this.isOpen)
					this.frameNode.style.height = event.data.height + 'px';
				this.insertTopBar(typeof(event.data) == 'object' ? event.data.title : event.data);
				this._showContent();
			}	

			if(event.data.action == "CloseHelper")
			{
				this.closePopup();
			}

			if(event.data.action == "ChangeHeight")
			{
				if(event.data.height > 0)
				{
					this.changeHeight(event.data.height);
				}
			}			
			
			if(event.data.action == "SetCounter")
			{
				BX.Bitrix24.Helper.showNotification(event.data.num);
			}
		}, this));
	
		BX.addCustomEvent("onTopPanelCollapse", function(){
			if(BX.Bitrix24.Helper.isOpen)
			{
				BX.Bitrix24.Helper.show();
			}
		});

		if (params.needCheckNotify == "Y")
		{
			this.checkNotification();
		}
	},

	setBlueHeroView : function()
	{
		if (!this.currentStepId)
			return;

		BX.ajax.post(
			this.ajaxUrl,
			{
				sessid:  BX.bitrix_sessid(),
				action: "setView",
				currentStepId: this.currentStepId
			},
			function() {}
		);
	},

	createFrame : function ()
	{
		this.frameNode = BX.create('iframe', {
			attrs: {
				className: 'bx-help-frame',
				frameborder: 0,
				name: 'help',
				id: 'help-frame'
			}
		});

		BX.bind(this.frameNode, 'load',BX.proxy(function(){
			this.popupNode.scrollTop = 0;
		}, this))
	},

	_showContent : function()
	{
		this.frameNode.style.opacity = 1;

		if(this.topBar.classList)
		{
			this.topBar.classList.add('bx-help-nav-fixed');
			this.topBar.classList.add('bx-help-nav-show');
		}
		else {
			BX.addClass(this.topBar,'bx-help-nav-fixed');
			BX.addClass(this.topBar, 'bx-help-nav-show');
		}

		this.popupLoader.classList.remove('bx-help-popup-loader-show');
	},

	_setPosFixed : function ()
	{
		document.body.style.width = document.body.offsetWidth + 'px';
		document.body.style.overflow = 'hidden';
	},

	_clearPosFixed : function()
	{
		document.body.style.width = 'auto';
		document.body.style.overflow = '';
	},

	createCloseBtn : function()
	{
		this.closeBtn = BX.create('div', {
			attrs: {
				className: 'bx-help-close'
			},
			children : [BX.create('div', {attrs: {className: 'bx-help-close-inner'}})]
		});

		BX.bind(this.closeBtn, 'click', BX.proxy(this.closePopup, this))
	},

	insertTopBar : function(node)
	{
		this.topBar.innerHTML= this.topBarHtml + node;
	},

	createPopup : function()
	{
		this.curtainNode = BX.create('div', {
			attrs: {
				"className": 'bx-help-curtain'
			}
		});

		this.popupNode = BX.create('div', {
			children: [
				this.frameNode,
				this.topBar,
				this.popupLoader
			],
			attrs: {
				className: 'bx-help-main'
			}
		});

		document.body.appendChild(this.curtainNode);
		document.body.appendChild(this.popupNode);
		document.body.appendChild(this.closeBtn);
	},

	closePopup : function ()
	{
		clearTimeout(this.shadowTimer); 
		clearTimeout(this.helpTimer); 
		BX.unbind(this.popupNode, 'transitionend', BX.proxy(this.loadFrame, this));

		BX.unbind(document, 'keydown', BX.proxy(this._close, this));
		BX.unbind(document, 'click', BX.proxy(this._close, this));

		if(this.popupNode.style.transition !== undefined)
			BX.bind(this.popupNode, 'transitionend', BX.proxy(this._clearPosFixed, this));
		else
			this._clearPosFixed();


		this.popupNode.style.width = 0;
		this.topBar.style.width = 0;

		if(this.topBar.classList){
			this.topBar.classList.remove('bx-help-nav-fixed');
			this.closeBtn.classList.remove('bx-help-close-anim');
		}
		else{
			BX.removeClass(this.topBar, 'bx-help-nav-fixed');
			BX.removeClass(this.closeBtn, 'bx-help-close-anim');
		}

		this.topBar.style.top = this.getTopCord().top + 'px';

		this.helpTimer = setTimeout(BX.proxy(function(){
			this.curtainNode.style.opacity = 0;
			this.closeBtn.style.display = 'none';

			if(this.openBtn.classList)
				this.openBtn.classList.remove('help-block-active');

		}, this),500);

		this.shadowTimer = setTimeout(BX.proxy(function(){
			this.frameNode.src = this.frameCloseUrl;
			this.popupNode.style.display = 'none';
			this.curtainNode.style.display = 'none';
			this.frameNode.style.opacity = 0;
			this.frameNode.style.height = 0;
			this.popupLoader.classList.remove('bx-help-popup-loader-show');
			BX.unbind(this.popupNode, 'transitionend', BX.proxy(this._clearPosFixed, this));

			if(this.topBar.classList)
				this.topBar.classList.remove('bx-help-nav-show');
			else
				BX.removeClass(this.topBar, 'bx-help-nav-show');
			this.isOpen = false;

		},this),800);

		
	},

	show : function(additionalParam)
	{
		if (typeof B24 === "object")
			B24.goUp();
		
		if (typeof additionalParam === "string")
		{
			this.frameOpenUrl = this.frameOpenUrl + "&" + additionalParam;
		}

		var top = this.getTopCord().top;
		var right = this.getTopCord().right;
		clearTimeout(this.shadowTimer); 
		clearTimeout(this.helpTimer); 

		this._setPosFixed();

		this.curtainNode.style.top = top +'px';
		this.curtainNode.style.width = this.getTopCord().right + 'px';
		this.curtainNode.style.display = 'block';
		this.popupNode.style.display = 'block';
		this.popupNode.style.paddingTop = top + 'px';
		this.topBar.style.top = top + 'px';
		this.closeBtn.style.top = (top - 63) + 'px';
		this.closeBtn.style.left = (right - 63) + 'px';
		this.closeBtn.style.display = 'block';
		this.popupLoader.style.top = top + 'px';

		if(this.openBtn.classList)
			this.openBtn.classList.add('help-block-active');

		if(this.popupNode.style.transition !== undefined){
			BX.bind(this.popupNode, 'transitionend', BX.proxy(this.loadFrame, this));
		}else {
			this.loadFrame(null);
		}

		this.shadowTimer = setTimeout(BX.proxy(function(){
			this.curtainNode.style.opacity = 1;

			if(this.closeBtn.classList)
				this.closeBtn.classList.add('bx-help-close-anim');
			else
				BX.addClass(this.closeBtn, 'bx-help-close-anim');
		}, this),25);

		this.helpTimer = setTimeout(BX.proxy(function(){
			this.popupNode.style.width = 860 + 'px';
			this.topBar.style.width = 860 + 'px';
			this.popupLoader.classList.add('bx-help-popup-loader-show');

			BX.bind(document, 'keydown', BX.proxy(this._close, this));
			BX.bind(document, 'click', BX.proxy(this._close, this));
			this.isOpen = true;

		}, this),300);

		
	},

	_close : function(event)
	{
		event = event || window.event;
		var target = event.target || event.srcElement;

		if(event.type == 'click'){
			BX.PreventDefault(event);
		}

		if(event.keyCode == 27){
			this.closePopup();
		}

		while(target != document.documentElement)
		{
			if (target == this.popupNode || target == this.closeBtn || target == this.topBar)
			{
				break;
			}
			else if(target == document.body && !event.keyCode){
				this.closePopup();
				break;
			}
			target = target.parentNode;
		}
	},

	loadFrame : function(event)
	{
		if(event !== null){
			event = event || window.event;
			var target = event.target || event.srcElement;

			if(target == this.popupNode)
				this.frameNode.src = this.frameOpenUrl;
		}else {
			this.frameNode.src = this.frameOpenUrl;
		}
	},

	reloadFrame : function(url)
	{
		this.frameNode.style.opacity = 0;
		this.frameNode.src = url;

		if(this.topBar.classList)
			this.topBar.classList.remove('bx-help-nav-show');
		else
			BX.removeClass(this.topBar, 'bx-help-nav-show');

		this.popupNode.scrollTop = 0;
	},
	getTopCord : function()
	{
		var pos = BX.pos(this.header);
		return {
			top:pos.bottom,
			right : pos.right
		}
	},

	changeHeight : function(height)
	{
		if(height > 0)
			this.frameNode.style.height = height + 'px';
	},

	showNotification : function(num)
	{
		if (!isNaN(parseFloat(num)) && isFinite(num) && num > 0)
		{
			var numBlock = '<div class="help-block-counter">' + (num > 99 ? '99+' : num) + '</div>';
		}
		else
		{
			numBlock = "";
		}
//		this.notifyBlock.innerHTML = numBlock;

		this.setNotification(num);
	},

	showAnimateHero : function(url)
	{
		if (!url)
			return;

		BX.ajax({
			method : "GET",
			dataType: 'html',
			url: this.helpUrl + url,
			data: {},
			onsuccess: BX.proxy(function(res)
			{
				if (res)
				{
					BX.load([this.runtimeUrl], function () {
						eval(res);
					});
				}
			}, this)
		});
	},

	setNotification : function(num, time)
	{
		BX.ajax({
			method: "POST",
			dataType: 'json',
			url: this.ajaxUrl,
			data:
			{
				sessid:  BX.bitrix_sessid(),
				action: "setNotify",
				num: num,
				time: time
			},
			onsuccess: BX.proxy(function (res) {

			}, this)
		});
	},

	checkNotification : function()
	{
		BX.ajax({
			method : "POST",
			dataType: 'json',
			url: this.notifyUrl,
			data: this.notifyData,
			onsuccess: BX.proxy(function(res)
			{
				if (!isNaN(res.num))
				{
					this.showNotification(res.num);

					if (res.id)
					{
						this.notifyId = res.id;
						this.notifyText = res.body;
						this.notifyButton = res.button;
					}

				 	if (res.url)
						this.showAnimateHero(res.url);
				}
				else
				{
					this.setNotification('', 'hour');
				}
			}, this),
			onfailure: BX.proxy(function(){
				this.setNotification('', 'hour');
			}, this)
		});
	}
};

BX.namespace("BX.Bitrix24.SystemAuthForm");

BX.Bitrix24.SystemAuthForm =
{
	licenseHandler : function(params)
	{
		if (typeof params !== "object")
			return;

		var url = params.COUNTER_URL || "",
			licensePath = params.LICENSE_PATH || "",
			host = params.HOST || "";

		BX.ajax.post(
			url,
			{
				action: "upgradeButton",
				host: host
			},
			BX.proxy(function(){
				document.location.href = licensePath;
			}, this)
		);
	}
};