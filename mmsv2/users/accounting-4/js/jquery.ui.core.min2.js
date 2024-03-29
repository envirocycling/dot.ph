/*!
 * jQuery UI 1.8.16
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI
 */
(function(c,j){
    function k(a,b){
        var d=a.nodeName.toLowerCase();
        if("area"===d){
            b=a.parentNode;
            d=b.name;
            if(!a.href||!d||b.nodeName.toLowerCase()!=="map")return false;
            a=c("img[usemap=#"+d+"]")[0];
            return!!a&&l(a)
            }
            return(/input|select|textarea|button|object/.test(d)?!a.disabled:"a"==d?a.href||b:b)&&l(a)
        }
        function l(a){
        return!c(a).parents().andSelf().filter(function(){
            return c.curCSS(this,"visibility")==="hidden"||c.expr.filters.hidden(this)
            }).length
        }
        c.ui=c.ui||{};

    if(!c.ui.version){
        c.extend(c.ui,{
            version:"1.8.16",
            keyCode:{
                ALT:18,
                BACKSPACE:8,
                CAPS_LOCK:20,
                COMMA:188,
                COMMAND:91,
                COMMAND_LEFT:91,
                COMMAND_RIGHT:93,
                CONTROL:17,
                DELETE:46,
                DOWN:40,
                END:35,
                ENTER:13,
                ESCAPE:27,
                HOME:36,
                INSERT:45,
                LEFT:37,
                MENU:93,
                NUMPAD_ADD:107,
                NUMPAD_DECIMAL:110,
                NUMPAD_DIVIDE:111,
                NUMPAD_ENTER:108,
                NUMPAD_MULTIPLY:106,
                NUMPAD_SUBTRACT:109,
                PAGE_DOWN:34,
                PAGE_UP:33,
                PERIOD:190,
                RIGHT:39,
                SHIFT:16,
                SPACE:32,
                TAB:9,
                UP:38,
                WINDOWS:91
            }
        });
    c.fn.extend({
        propAttr:c.fn.prop||c.fn.attr,
        _focus:c.fn.focus,
        focus:function(a,b){
            return typeof a==="number"?this.each(function(){
                var d=
                this;
                setTimeout(function(){
                    c(d).focus();
                    b&&b.call(d)
                    },a)
                }):this._focus.apply(this,arguments)
            },
        scrollParent:function(){
            var a;
            a=c.browser.msie&&/(static|relative)/.test(this.css("position"))||/absolute/.test(this.css("position"))?this.parents().filter(function(){
                return/(relative|absolute|fixed)/.test(c.curCSS(this,"position",1))&&/(auto|scroll)/.test(c.curCSS(this,"overflow",1)+c.curCSS(this,"overflow-y",1)+c.curCSS(this,"overflow-x",1))
                }).eq(0):this.parents().filter(function(){
                return/(auto|scroll)/.test(c.curCSS(this,
                    "overflow",1)+c.curCSS(this,"overflow-y",1)+c.curCSS(this,"overflow-x",1))
                }).eq(0);
            return/fixed/.test(this.css("position"))||!a.length?c(document):a
            },
        zIndex:function(a){
            if(a!==j)return this.css("zIndex",a);
            if(this.length){
                a=c(this[0]);
                for(var b;a.length&&a[0]!==document;){
                    b=a.css("position");
                    if(b==="absolute"||b==="relative"||b==="fixed"){
                        b=parseInt(a.css("zIndex"),10);
                        if(!isNaN(b)&&b!==0)return b
                            }
                            a=a.parent()
                    }
                }
                return 0
        },
    disableSelection:function(){
        return this.bind((c.support.selectstart?"selectstart":
            "mousedown")+".ui-disableSelection",function(a){
            a.preventDefault()
            })
        },
    enableSelection:function(){
        return this.unbind(".ui-disableSelection")
        }
    });
c.each(["Width","Height"],function(a,b){
    function d(f,g,m,n){
        c.each(e,function(){
            g-=parseFloat(c.curCSS(f,"padding"+this,true))||0;
            if(m)g-=parseFloat(c.curCSS(f,"border"+this+"Width",true))||0;
            if(n)g-=parseFloat(c.curCSS(f,"margin"+this,true))||0
                });
        return g
        }
        var e=b==="Width"?["Left","Right"]:["Top","Bottom"],h=b.toLowerCase(),i={
        innerWidth:c.fn.innerWidth,
        innerHeight:c.fn.innerHeight,
        outerWidth:c.fn.outerWidth,
        outerHeight:c.fn.outerHeight
        };

    c.fn["inner"+b]=function(f){
        if(f===j)return i["inner"+b].call(this);
        return this.each(function(){
            c(this).css(h,d(this,f)+"px")
            })
        };

    c.fn["outer"+b]=function(f,g){
        if(typeof f!=="number")return i["outer"+b].call(this,f);
        return this.each(function(){
            c(this).css(h,d(this,f,true,g)+"px")
            })
        }
    });
c.extend(c.expr[":"],{
    data:function(a,b,d){
        return!!c.data(a,d[3])
        },
    focusable:function(a){
        return k(a,!isNaN(c.attr(a,"tabindex")))
        },
    tabbable:function(a){
        var b=c.attr(a,
            "tabindex"),d=isNaN(b);
        return(d||b>=0)&&k(a,!d)
        }
    });
c(function(){
    var a=document.body,b=a.appendChild(b=document.createElement("div"));
    c.extend(b.style,{
        minHeight:"100px",
        height:"auto",
        padding:0,
        borderWidth:0
    });
    c.support.minHeight=b.offsetHeight===100;
    c.support.selectstart="onselectstart"in b;
    a.removeChild(b).style.display="none"
    });
c.extend(c.ui,{
    plugin:{
        add:function(a,b,d){
            a=c.ui[a].prototype;
            for(var e in d){
                a.plugins[e]=a.plugins[e]||[];
                a.plugins[e].push([b,d[e]])
                }
            },
    call:function(a,b,d){
        if((b=a.plugins[b])&&
            a.element[0].parentNode)for(var e=0;e<b.length;e++)a.options[b[e][0]]&&b[e][1].apply(a.element,d)
            }
        },
contains:function(a,b){
    return document.compareDocumentPosition?a.compareDocumentPosition(b)&16:a!==b&&a.contains(b)
    },
hasScroll:function(a,b){
    if(c(a).css("overflow")==="hidden")return false;
    b=b&&b==="left"?"scrollLeft":"scrollTop";
    var d=false;
    if(a[b]>0)return true;
    a[b]=1;
    d=a[b]>0;
    a[b]=0;
    return d
    },
isOverAxis:function(a,b,d){
    return a>b&&a<b+d
    },
isOver:function(a,b,d,e,h,i){
    return c.ui.isOverAxis(a,d,h)&&
    c.ui.isOverAxis(b,e,i)
    }
})
}
})(jQuery);


/*!
 * jQuery UI Widget 1.8.16
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Widget
 */
(function(b,j){
    if(b.cleanData){
        var k=b.cleanData;
        b.cleanData=function(a){
            for(var c=0,d;(d=a[c])!=null;c++)try{
                b(d).triggerHandler("remove")
                }catch(e){}
                k(a)
            }
        }else{
    var l=b.fn.remove;
    b.fn.remove=function(a,c){
        return this.each(function(){
            if(!c)if(!a||b.filter(a,[this]).length)b("*",this).add([this]).each(function(){
                try{
                    b(this).triggerHandler("remove")
                    }catch(d){}
            });
        return l.call(b(this),a,c)
            })
    }
}
b.widget=function(a,c,d){
    var e=a.split(".")[0],f;
    a=a.split(".")[1];
    f=e+"-"+a;
    if(!d){
        d=c;
        c=b.Widget
        }
        b.expr[":"][f]=
    function(h){
        return!!b.data(h,a)
        };

    b[e]=b[e]||{};

    b[e][a]=function(h,g){
        arguments.length&&this._createWidget(h,g)
        };

    c=new c;
    c.options=b.extend(true,{},c.options);
    b[e][a].prototype=b.extend(true,c,{
        namespace:e,
        widgetName:a,
        widgetEventPrefix:b[e][a].prototype.widgetEventPrefix||a,
        widgetBaseClass:f
    },d);
    b.widget.bridge(a,b[e][a])
    };

b.widget.bridge=function(a,c){
    b.fn[a]=function(d){
        var e=typeof d==="string",f=Array.prototype.slice.call(arguments,1),h=this;
        d=!e&&f.length?b.extend.apply(null,[true,d].concat(f)):
        d;
        if(e&&d.charAt(0)==="_")return h;
        e?this.each(function(){
            var g=b.data(this,a),i=g&&b.isFunction(g[d])?g[d].apply(g,f):g;
            if(i!==g&&i!==j){
                h=i;
                return false
                }
            }):this.each(function(){
        var g=b.data(this,a);
        g?g.option(d||{})._init():b.data(this,a,new c(d,this))
        });
    return h
    }
};

b.Widget=function(a,c){
    arguments.length&&this._createWidget(a,c)
    };

b.Widget.prototype={
    widgetName:"widget",
    widgetEventPrefix:"",
    options:{
        disabled:false
    },
    _createWidget:function(a,c){
        b.data(c,this.widgetName,this);
        this.element=b(c);
        this.options=
        b.extend(true,{},this.options,this._getCreateOptions(),a);
        var d=this;
        this.element.bind("remove."+this.widgetName,function(){
            d.destroy()
            });
        this._create();
        this._trigger("create");
        this._init()
        },
    _getCreateOptions:function(){
        return b.metadata&&b.metadata.get(this.element[0])[this.widgetName]
        },
    _create:function(){},
    _init:function(){},
    destroy:function(){
        this.element.unbind("."+this.widgetName).removeData(this.widgetName);
        this.widget().unbind("."+this.widgetName).removeAttr("aria-disabled").removeClass(this.widgetBaseClass+
            "-disabled ui-state-disabled")
        },
    widget:function(){
        return this.element
        },
    option:function(a,c){
        var d=a;
        if(arguments.length===0)return b.extend({},this.options);
        if(typeof a==="string"){
            if(c===j)return this.options[a];
            d={};

            d[a]=c
            }
            this._setOptions(d);
        return this
        },
    _setOptions:function(a){
        var c=this;
        b.each(a,function(d,e){
            c._setOption(d,e)
            });
        return this
        },
    _setOption:function(a,c){
        this.options[a]=c;
        if(a==="disabled")this.widget()[c?"addClass":"removeClass"](this.widgetBaseClass+"-disabled ui-state-disabled").attr("aria-disabled",
            c);
        return this
        },
    enable:function(){
        return this._setOption("disabled",false)
        },
    disable:function(){
        return this._setOption("disabled",true)
        },
    _trigger:function(a,c,d){
        var e=this.options[a];
        c=b.Event(c);
        c.type=(a===this.widgetEventPrefix?a:this.widgetEventPrefix+a).toLowerCase();
        d=d||{};

        if(c.originalEvent){
            a=b.event.props.length;
            for(var f;a;){
                f=b.event.props[--a];
                c[f]=c.originalEvent[f]
                }
            }
            this.element.trigger(c,d);
    return!(b.isFunction(e)&&e.call(this.element[0],c,d)===false||c.isDefaultPrevented())
    }
}
})(jQuery);

(function(c){
    c.widget("ui.accordion",{
        options:{
            active:0,
            animated:"slide",
            autoHeight:true,
            clearStyle:false,
            collapsible:false,
            event:"click",
            fillSpace:false,
            header:"> li > :first-child,> :not(li):even",
            icons:{
                header:"ui-icon-triangle-1-e",
                headerSelected:"ui-icon-triangle-1-s"
            },
            navigation:false,
            navigationFilter:function(){
                return this.href.toLowerCase()===location.href.toLowerCase()
                }
            },
    _create:function(){
        var a=this,b=a.options;
        a.running=0;
        a.element.addClass("ui-accordion ui-widget ui-helper-reset").children("li").addClass("ui-accordion-li-fix");
        a.headers=a.element.find(b.header).addClass("ui-accordion-header ui-helper-reset ui-state-default ui-corner-all").bind("mouseenter.accordion",function(){
            b.disabled||c(this).addClass("ui-state-hover")
            }).bind("mouseleave.accordion",function(){
            b.disabled||c(this).removeClass("ui-state-hover")
            }).bind("focus.accordion",function(){
            b.disabled||c(this).addClass("ui-state-focus")
            }).bind("blur.accordion",function(){
            b.disabled||c(this).removeClass("ui-state-focus")
            });
        a.headers.next().addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom");
        if(b.navigation){
            var d=a.element.find("a").filter(b.navigationFilter).eq(0);
            if(d.length){
                var h=d.closest(".ui-accordion-header");
                a.active=h.length?h:d.closest(".ui-accordion-content").prev()
                }
            }
        a.active=a._findActive(a.active||b.active).addClass("ui-state-default ui-state-active").toggleClass("ui-corner-all").toggleClass("ui-corner-top");
        a.active.next().addClass("ui-accordion-content-active");
        a._createIcons();
        a.resize();
        a.element.attr("role","tablist");
        a.headers.attr("role","tab").bind("keydown.accordion",
        function(f){
            return a._keydown(f)
            }).next().attr("role","tabpanel");
        a.headers.not(a.active||"").attr({
        "aria-expanded":"false",
        "aria-selected":"false",
        tabIndex:-1
    }).next().hide();
        a.active.length?a.active.attr({
        "aria-expanded":"true",
        "aria-selected":"true",
        tabIndex:0
    }):a.headers.eq(0).attr("tabIndex",0);
        c.browser.safari||a.headers.find("a").attr("tabIndex",-1);
        b.event&&a.headers.bind(b.event.split(" ").join(".accordion ")+".accordion",function(f){
        a._clickHandler.call(a,f,this);
        f.preventDefault()
        })
    },
    _createIcons:function(){
        var a=
        this.options;
        if(a.icons){
            c("<span></span>").addClass("ui-icon "+a.icons.header).prependTo(this.headers);
            this.active.children(".ui-icon").toggleClass(a.icons.header).toggleClass(a.icons.headerSelected);
            this.element.addClass("ui-accordion-icons")
            }
        },
_destroyIcons:function(){
    this.headers.children(".ui-icon").remove();
    this.element.removeClass("ui-accordion-icons")
    },
destroy:function(){
    var a=this.options;
    this.element.removeClass("ui-accordion ui-widget ui-helper-reset").removeAttr("role");
    this.headers.unbind(".accordion").removeClass("ui-accordion-header ui-accordion-disabled ui-helper-reset ui-state-default ui-corner-all ui-state-active ui-state-disabled ui-corner-top").removeAttr("role").removeAttr("aria-expanded").removeAttr("aria-selected").removeAttr("tabIndex");
    this.headers.find("a").removeAttr("tabIndex");
    this._destroyIcons();
    var b=this.headers.next().css("display","").removeAttr("role").removeClass("ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content ui-accordion-content-active ui-accordion-disabled ui-state-disabled");
    if(a.autoHeight||a.fillHeight)b.css("height","");
    return c.Widget.prototype.destroy.call(this)
    },
_setOption:function(a,b){
    c.Widget.prototype._setOption.apply(this,arguments);
    a=="active"&&this.activate(b);
    if(a=="icons"){
        this._destroyIcons();
        b&&this._createIcons()
        }
        if(a=="disabled")this.headers.add(this.headers.next())[b?"addClass":"removeClass"]("ui-accordion-disabled ui-state-disabled")
        },
_keydown:function(a){
    if(!(this.options.disabled||a.altKey||a.ctrlKey)){
        var b=c.ui.keyCode,d=this.headers.length,h=this.headers.index(a.target),f=false;
        switch(a.keyCode){
            case b.RIGHT:case b.DOWN:
                f=this.headers[(h+1)%d];
                break;
            case b.LEFT:case b.UP:
                f=this.headers[(h-1+d)%d];
                break;
            case b.SPACE:case b.ENTER:
                this._clickHandler({
                target:a.target
                },a.target);
            a.preventDefault()
                }
                if(f){
            c(a.target).attr("tabIndex",-1);
            c(f).attr("tabIndex",0);
            f.focus();
            return false
            }
            return true
        }
    },
resize:function(){
    var a=this.options,b;
    if(a.fillSpace){
        if(c.browser.msie){
            var d=this.element.parent().css("overflow");
            this.element.parent().css("overflow","hidden")
            }
            b=this.element.parent().height();
        c.browser.msie&&this.element.parent().css("overflow",d);
        this.headers.each(function(){
            b-=c(this).outerHeight(true)
            });
        this.headers.next().each(function(){
            c(this).height(Math.max(0,b-c(this).innerHeight()+
                c(this).height()))
            }).css("overflow","auto")
        }else if(a.autoHeight){
        b=0;
        this.headers.next().each(function(){
            b=Math.max(b,c(this).height("").height())
            }).height(b)
        }
        return this
    },
activate:function(a){
    this.options.active=a;
    a=this._findActive(a)[0];
    this._clickHandler({
        target:a
    },a);
    return this
    },
_findActive:function(a){
    return a?typeof a==="number"?this.headers.filter(":eq("+a+")"):this.headers.not(this.headers.not(a)):a===false?c([]):this.headers.filter(":eq(0)")
    },
_clickHandler:function(a,b){
    var d=this.options;
    if(!d.disabled)if(a.target){
        a=c(a.currentTarget||b);
        b=a[0]===this.active[0];
        d.active=d.collapsible&&b?false:this.headers.index(a);
        if(!(this.running||!d.collapsible&&b)){
            var h=this.active;
            j=a.next();
            g=this.active.next();
            e={
                options:d,
                newHeader:b&&d.collapsible?c([]):a,
                oldHeader:this.active,
                newContent:b&&d.collapsible?c([]):j,
                oldContent:g
            };

            var f=this.headers.index(this.active[0])>this.headers.index(a[0]);
            this.active=b?c([]):a;
            this._toggle(j,g,e,b,f);
            h.removeClass("ui-state-active ui-corner-top").addClass("ui-state-default ui-corner-all").children(".ui-icon").removeClass(d.icons.headerSelected).addClass(d.icons.header);
            if(!b){
                a.removeClass("ui-state-default ui-corner-all").addClass("ui-state-active ui-corner-top").children(".ui-icon").removeClass(d.icons.header).addClass(d.icons.headerSelected);
                a.next().addClass("ui-accordion-content-active")
                }
            }
    }else if(d.collapsible){
    this.active.removeClass("ui-state-active ui-corner-top").addClass("ui-state-default ui-corner-all").children(".ui-icon").removeClass(d.icons.headerSelected).addClass(d.icons.header);
    this.active.next().addClass("ui-accordion-content-active");
    var g=this.active.next(),
    e={
        options:d,
        newHeader:c([]),
        oldHeader:d.active,
        newContent:c([]),
        oldContent:g
    },j=this.active=c([]);
    this._toggle(j,g,e)
    }
},
_toggle:function(a,b,d,h,f){
    var g=this,e=g.options;
    g.toShow=a;
    g.toHide=b;
    g.data=d;
    var j=function(){
        if(g)return g._completed.apply(g,arguments)
            };

    g._trigger("changestart",null,g.data);
    g.running=b.size()===0?a.size():b.size();
    if(e.animated){
        d={};

        d=e.collapsible&&h?{
            toShow:c([]),
            toHide:b,
            complete:j,
            down:f,
            autoHeight:e.autoHeight||e.fillSpace
            }:{
            toShow:a,
            toHide:b,
            complete:j,
            down:f,
            autoHeight:e.autoHeight||
            e.fillSpace
            };

        if(!e.proxied)e.proxied=e.animated;
        if(!e.proxiedDuration)e.proxiedDuration=e.duration;
        e.animated=c.isFunction(e.proxied)?e.proxied(d):e.proxied;
        e.duration=c.isFunction(e.proxiedDuration)?e.proxiedDuration(d):e.proxiedDuration;
        h=c.ui.accordion.animations;
        var i=e.duration,k=e.animated;
        if(k&&!h[k]&&!c.easing[k])k="slide";
        h[k]||(h[k]=function(l){
            this.slide(l,{
                easing:k,
                duration:i||700
                })
            });
        h[k](d)
        }else{
        if(e.collapsible&&h)a.toggle();
        else{
            b.hide();
            a.show()
            }
            j(true)
        }
        b.prev().attr({
        "aria-expanded":"false",
        "aria-selected":"false",
        tabIndex:-1
    }).blur();
    a.prev().attr({
        "aria-expanded":"true",
        "aria-selected":"true",
        tabIndex:0
    }).focus()
    },
_completed:function(a){
    this.running=a?0:--this.running;
    if(!this.running){
        this.options.clearStyle&&this.toShow.add(this.toHide).css({
            height:"",
            overflow:""
        });
        this.toHide.removeClass("ui-accordion-content-active");
        if(this.toHide.length)this.toHide.parent()[0].className=this.toHide.parent()[0].className;
        this._trigger("change",null,this.data)
        }
    }
});
c.extend(c.ui.accordion,{
    version:"1.8.16",
    animations:{
        slide:function(a,b){
            a=c.extend({
                easing:"swing",
                duration:300
            },a,b);
            if(a.toHide.size())if(a.toShow.size()){
                var d=a.toShow.css("overflow"),h=0,f={},g={},e;
                b=a.toShow;
                e=b[0].style.width;
                b.width(parseInt(b.parent().width(),10)-parseInt(b.css("paddingLeft"),10)-parseInt(b.css("paddingRight"),10)-(parseInt(b.css("borderLeftWidth"),10)||0)-(parseInt(b.css("borderRightWidth"),10)||0));
                c.each(["height","paddingTop","paddingBottom"],function(j,i){
                    g[i]="hide";
                    j=(""+c.css(a.toShow[0],i)).match(/^([\d+-.]+)(.*)$/);
                    f[i]={
                        value:j[1],
                        unit:j[2]||"px"
                        }
                    });
            a.toShow.css({
                height:0,
                overflow:"hidden"
            }).show();
                a.toHide.filter(":hidden").each(a.complete).end().filter(":visible").animate(g,{
                step:function(j,i){
                    if(i.prop=="height")h=i.end-i.start===0?0:(i.now-i.start)/(i.end-i.start);
                    a.toShow[0].style[i.prop]=h*f[i.prop].value+f[i.prop].unit
                    },
                duration:a.duration,
                easing:a.easing,
                complete:function(){
                    a.autoHeight||a.toShow.css("height","");
                    a.toShow.css({
                        width:e,
                        overflow:d
                    });
                    a.complete()
                    }
                })
            }else a.toHide.animate({
            height:"hide",
            paddingTop:"hide",
            paddingBottom:"hide"
        },a);else a.toShow.animate({
        height:"show",
        paddingTop:"show",
        paddingBottom:"show"
    },a)
    },
bounceslide:function(a){
    this.slide(a,{
        easing:a.down?"easeOutBounce":"swing",
        duration:a.down?1E3:200
        })
    }
}
})
})(jQuery);


jQuery.effects||function(f,j){
    function m(c){
        var a;
        if(c&&c.constructor==Array&&c.length==3)return c;
        if(a=/rgb\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*\)/.exec(c))return[parseInt(a[1],10),parseInt(a[2],10),parseInt(a[3],10)];
        if(a=/rgb\(\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*\)/.exec(c))return[parseFloat(a[1])*2.55,parseFloat(a[2])*2.55,parseFloat(a[3])*2.55];
        if(a=/#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/.exec(c))return[parseInt(a[1],
            16),parseInt(a[2],16),parseInt(a[3],16)];
        if(a=/#([a-fA-F0-9])([a-fA-F0-9])([a-fA-F0-9])/.exec(c))return[parseInt(a[1]+a[1],16),parseInt(a[2]+a[2],16),parseInt(a[3]+a[3],16)];
        if(/rgba\(0, 0, 0, 0\)/.exec(c))return n.transparent;
        return n[f.trim(c).toLowerCase()]
        }
        function s(c,a){
        var b;
        do{
            b=f.curCSS(c,a);
            if(b!=""&&b!="transparent"||f.nodeName(c,"body"))break;
            a="backgroundColor"
            }while(c=c.parentNode);
        return m(b)
        }
        function o(){
        var c=document.defaultView?document.defaultView.getComputedStyle(this,null):this.currentStyle,
        a={},b,d;
        if(c&&c.length&&c[0]&&c[c[0]])for(var e=c.length;e--;){
            b=c[e];
            if(typeof c[b]=="string"){
                d=b.replace(/\-(\w)/g,function(g,h){
                    return h.toUpperCase()
                    });
                a[d]=c[b]
                }
            }else for(b in c)if(typeof c[b]==="string")a[b]=c[b];return a
    }
    function p(c){
    var a,b;
    for(a in c){
        b=c[a];
        if(b==null||f.isFunction(b)||a in t||/scrollbar/.test(a)||!/color/i.test(a)&&isNaN(parseFloat(b)))delete c[a]
    }
    return c
    }
    function u(c,a){
    var b={
        _:0
    },d;
    for(d in a)if(c[d]!=a[d])b[d]=a[d];return b
    }
    function k(c,a,b,d){
    if(typeof c=="object"){
        d=
        a;
        b=null;
        a=c;
        c=a.effect
        }
        if(f.isFunction(a)){
        d=a;
        b=null;
        a={}
    }
    if(typeof a=="number"||f.fx.speeds[a]){
    d=b;
    b=a;
    a={}
}
if(f.isFunction(b)){
    d=b;
    b=null
    }
    a=a||{};

b=b||a.duration;
b=f.fx.off?0:typeof b=="number"?b:b in f.fx.speeds?f.fx.speeds[b]:f.fx.speeds._default;
d=d||a.complete;
return[c,a,b,d]
}
function l(c){
    if(!c||typeof c==="number"||f.fx.speeds[c])return true;
    if(typeof c==="string"&&!f.effects[c])return true;
    return false
    }
    f.effects={};

f.each(["backgroundColor","borderBottomColor","borderLeftColor","borderRightColor",
    "borderTopColor","borderColor","color","outlineColor"],function(c,a){
        f.fx.step[a]=function(b){
            if(!b.colorInit){
                b.start=s(b.elem,a);
                b.end=m(b.end);
                b.colorInit=true
                }
                b.elem.style[a]="rgb("+Math.max(Math.min(parseInt(b.pos*(b.end[0]-b.start[0])+b.start[0],10),255),0)+","+Math.max(Math.min(parseInt(b.pos*(b.end[1]-b.start[1])+b.start[1],10),255),0)+","+Math.max(Math.min(parseInt(b.pos*(b.end[2]-b.start[2])+b.start[2],10),255),0)+")"
            }
        });
var n={
    aqua:[0,255,255],
    azure:[240,255,255],
    beige:[245,245,220],
    black:[0,
    0,0],
    blue:[0,0,255],
    brown:[165,42,42],
    cyan:[0,255,255],
    darkblue:[0,0,139],
    darkcyan:[0,139,139],
    darkgrey:[169,169,169],
    darkgreen:[0,100,0],
    darkkhaki:[189,183,107],
    darkmagenta:[139,0,139],
    darkolivegreen:[85,107,47],
    darkorange:[255,140,0],
    darkorchid:[153,50,204],
    darkred:[139,0,0],
    darksalmon:[233,150,122],
    darkviolet:[148,0,211],
    fuchsia:[255,0,255],
    gold:[255,215,0],
    green:[0,128,0],
    indigo:[75,0,130],
    khaki:[240,230,140],
    lightblue:[173,216,230],
    lightcyan:[224,255,255],
    lightgreen:[144,238,144],
    lightgrey:[211,
    211,211],
    lightpink:[255,182,193],
    lightyellow:[255,255,224],
    lime:[0,255,0],
    magenta:[255,0,255],
    maroon:[128,0,0],
    navy:[0,0,128],
    olive:[128,128,0],
    orange:[255,165,0],
    pink:[255,192,203],
    purple:[128,0,128],
    violet:[128,0,128],
    red:[255,0,0],
    silver:[192,192,192],
    white:[255,255,255],
    yellow:[255,255,0],
    transparent:[255,255,255]
    },q=["add","remove","toggle"],t={
    border:1,
    borderBottom:1,
    borderColor:1,
    borderLeft:1,
    borderRight:1,
    borderTop:1,
    borderWidth:1,
    margin:1,
    padding:1
};

f.effects.animateClass=function(c,a,b,
    d){
    if(f.isFunction(b)){
        d=b;
        b=null
        }
        return this.queue(function(){
        var e=f(this),g=e.attr("style")||" ",h=p(o.call(this)),r,v=e.attr("class");
        f.each(q,function(w,i){
            c[i]&&e[i+"Class"](c[i])
            });
        r=p(o.call(this));
        e.attr("class",v);
        e.animate(u(h,r),{
            queue:false,
            duration:a,
            easing:b,
            complete:function(){
                f.each(q,function(w,i){
                    c[i]&&e[i+"Class"](c[i])
                    });
                if(typeof e.attr("style")=="object"){
                    e.attr("style").cssText="";
                    e.attr("style").cssText=g
                    }else e.attr("style",g);
                d&&d.apply(this,arguments);
                f.dequeue(this)
                }
            })
    })
};
f.fn.extend({
    _addClass:f.fn.addClass,
    addClass:function(c,a,b,d){
        return a?f.effects.animateClass.apply(this,[{
            add:c
        },a,b,d]):this._addClass(c)
        },
    _removeClass:f.fn.removeClass,
    removeClass:function(c,a,b,d){
        return a?f.effects.animateClass.apply(this,[{
            remove:c
        },a,b,d]):this._removeClass(c)
        },
    _toggleClass:f.fn.toggleClass,
    toggleClass:function(c,a,b,d,e){
        return typeof a=="boolean"||a===j?b?f.effects.animateClass.apply(this,[a?{
            add:c
        }:{
            remove:c
        },b,d,e]):this._toggleClass(c,a):f.effects.animateClass.apply(this,
            [{
                toggle:c
            },a,b,d])
        },
    switchClass:function(c,a,b,d,e){
        return f.effects.animateClass.apply(this,[{
            add:a,
            remove:c
        },b,d,e])
        }
    });
f.extend(f.effects,{
    version:"1.8.16",
    save:function(c,a){
        for(var b=0;b<a.length;b++)a[b]!==null&&c.data("ec.storage."+a[b],c[0].style[a[b]])
            },
    restore:function(c,a){
        for(var b=0;b<a.length;b++)a[b]!==null&&c.css(a[b],c.data("ec.storage."+a[b]))
            },
    setMode:function(c,a){
        if(a=="toggle")a=c.is(":hidden")?"show":"hide";
        return a
        },
    getBaseline:function(c,a){
        var b;
        switch(c[0]){
            case "top":
                b=
                0;
                break;
            case "middle":
                b=0.5;
                break;
            case "bottom":
                b=1;
                break;
            default:
                b=c[0]/a.height
                }
                switch(c[1]){
            case "left":
                c=0;
                break;
            case "center":
                c=0.5;
                break;
            case "right":
                c=1;
                break;
            default:
                c=c[1]/a.width
                }
                return{
            x:c,
            y:b
        }
    },
createWrapper:function(c){
    if(c.parent().is(".ui-effects-wrapper"))return c.parent();
    var a={
        width:c.outerWidth(true),
        height:c.outerHeight(true),
        "float":c.css("float")
        },b=f("<div></div>").addClass("ui-effects-wrapper").css({
        fontSize:"100%",
        background:"transparent",
        border:"none",
        margin:0,
        padding:0
    }),
    d=document.activeElement;
    c.wrap(b);
    if(c[0]===d||f.contains(c[0],d))f(d).focus();
    b=c.parent();
    if(c.css("position")=="static"){
        b.css({
            position:"relative"
        });
        c.css({
            position:"relative"
        })
        }else{
        f.extend(a,{
            position:c.css("position"),
            zIndex:c.css("z-index")
            });
        f.each(["top","left","bottom","right"],function(e,g){
            a[g]=c.css(g);
            if(isNaN(parseInt(a[g],10)))a[g]="auto"
                });
        c.css({
            position:"relative",
            top:0,
            left:0,
            right:"auto",
            bottom:"auto"
        })
        }
        return b.css(a).show()
    },
removeWrapper:function(c){
    var a,b=document.activeElement;
    if(c.parent().is(".ui-effects-wrapper")){
        a=c.parent().replaceWith(c);
        if(c[0]===b||f.contains(c[0],b))f(b).focus();
        return a
        }
        return c
    },
setTransition:function(c,a,b,d){
    d=d||{};

    f.each(a,function(e,g){
        unit=c.cssUnit(g);
        if(unit[0]>0)d[g]=unit[0]*b+unit[1]
            });
    return d
    }
});
f.fn.extend({
    effect:function(c){
        var a=k.apply(this,arguments),b={
            options:a[1],
            duration:a[2],
            callback:a[3]
            };

        a=b.options.mode;
        var d=f.effects[c];
        if(f.fx.off||!d)return a?this[a](b.duration,b.callback):this.each(function(){
            b.callback&&b.callback.call(this)
            });
        return d.call(this,b)
        },
    _show:f.fn.show,
    show:function(c){
        if(l(c))return this._show.apply(this,arguments);
        else{
            var a=k.apply(this,arguments);
            a[1].mode="show";
            return this.effect.apply(this,a)
            }
        },
_hide:f.fn.hide,
hide:function(c){
    if(l(c))return this._hide.apply(this,arguments);
    else{
        var a=k.apply(this,arguments);
        a[1].mode="hide";
        return this.effect.apply(this,a)
        }
    },
__toggle:f.fn.toggle,
toggle:function(c){
    if(l(c)||typeof c==="boolean"||f.isFunction(c))return this.__toggle.apply(this,arguments);
    else{
        var a=k.apply(this,
            arguments);
        a[1].mode="toggle";
        return this.effect.apply(this,a)
        }
    },
cssUnit:function(c){
    var a=this.css(c),b=[];
    f.each(["em","px","%","pt"],function(d,e){
        if(a.indexOf(e)>0)b=[parseFloat(a),e]
            });
    return b
    }
});
f.easing.jswing=f.easing.swing;
f.extend(f.easing,{
    def:"easeOutQuad",
    swing:function(c,a,b,d,e){
        return f.easing[f.easing.def](c,a,b,d,e)
        },
    easeInQuad:function(c,a,b,d,e){
        return d*(a/=e)*a+b
        },
    easeOutQuad:function(c,a,b,d,e){
        return-d*(a/=e)*(a-2)+b
        },
    easeInOutQuad:function(c,a,b,d,e){
        if((a/=e/2)<1)return d/
            2*a*a+b;
        return-d/2*(--a*(a-2)-1)+b
        },
    easeInCubic:function(c,a,b,d,e){
        return d*(a/=e)*a*a+b
        },
    easeOutCubic:function(c,a,b,d,e){
        return d*((a=a/e-1)*a*a+1)+b
        },
    easeInOutCubic:function(c,a,b,d,e){
        if((a/=e/2)<1)return d/2*a*a*a+b;
        return d/2*((a-=2)*a*a+2)+b
        },
    easeInQuart:function(c,a,b,d,e){
        return d*(a/=e)*a*a*a+b
        },
    easeOutQuart:function(c,a,b,d,e){
        return-d*((a=a/e-1)*a*a*a-1)+b
        },
    easeInOutQuart:function(c,a,b,d,e){
        if((a/=e/2)<1)return d/2*a*a*a*a+b;
        return-d/2*((a-=2)*a*a*a-2)+b
        },
    easeInQuint:function(c,a,b,
        d,e){
        return d*(a/=e)*a*a*a*a+b
        },
    easeOutQuint:function(c,a,b,d,e){
        return d*((a=a/e-1)*a*a*a*a+1)+b
        },
    easeInOutQuint:function(c,a,b,d,e){
        if((a/=e/2)<1)return d/2*a*a*a*a*a+b;
        return d/2*((a-=2)*a*a*a*a+2)+b
        },
    easeInSine:function(c,a,b,d,e){
        return-d*Math.cos(a/e*(Math.PI/2))+d+b
        },
    easeOutSine:function(c,a,b,d,e){
        return d*Math.sin(a/e*(Math.PI/2))+b
        },
    easeInOutSine:function(c,a,b,d,e){
        return-d/2*(Math.cos(Math.PI*a/e)-1)+b
        },
    easeInExpo:function(c,a,b,d,e){
        return a==0?b:d*Math.pow(2,10*(a/e-1))+b
        },
    easeOutExpo:function(c,
        a,b,d,e){
        return a==e?b+d:d*(-Math.pow(2,-10*a/e)+1)+b
        },
    easeInOutExpo:function(c,a,b,d,e){
        if(a==0)return b;
        if(a==e)return b+d;
        if((a/=e/2)<1)return d/2*Math.pow(2,10*(a-1))+b;
        return d/2*(-Math.pow(2,-10*--a)+2)+b
        },
    easeInCirc:function(c,a,b,d,e){
        return-d*(Math.sqrt(1-(a/=e)*a)-1)+b
        },
    easeOutCirc:function(c,a,b,d,e){
        return d*Math.sqrt(1-(a=a/e-1)*a)+b
        },
    easeInOutCirc:function(c,a,b,d,e){
        if((a/=e/2)<1)return-d/2*(Math.sqrt(1-a*a)-1)+b;
        return d/2*(Math.sqrt(1-(a-=2)*a)+1)+b
        },
    easeInElastic:function(c,a,b,
        d,e){
        c=1.70158;
        var g=0,h=d;
        if(a==0)return b;
        if((a/=e)==1)return b+d;
        g||(g=e*0.3);
        if(h<Math.abs(d)){
            h=d;
            c=g/4
            }else c=g/(2*Math.PI)*Math.asin(d/h);
        return-(h*Math.pow(2,10*(a-=1))*Math.sin((a*e-c)*2*Math.PI/g))+b
        },
    easeOutElastic:function(c,a,b,d,e){
        c=1.70158;
        var g=0,h=d;
        if(a==0)return b;
        if((a/=e)==1)return b+d;
        g||(g=e*0.3);
        if(h<Math.abs(d)){
            h=d;
            c=g/4
            }else c=g/(2*Math.PI)*Math.asin(d/h);
        return h*Math.pow(2,-10*a)*Math.sin((a*e-c)*2*Math.PI/g)+d+b
        },
    easeInOutElastic:function(c,a,b,d,e){
        c=1.70158;
        var g=
        0,h=d;
        if(a==0)return b;
        if((a/=e/2)==2)return b+d;
        g||(g=e*0.3*1.5);
        if(h<Math.abs(d)){
            h=d;
            c=g/4
            }else c=g/(2*Math.PI)*Math.asin(d/h);
        if(a<1)return-0.5*h*Math.pow(2,10*(a-=1))*Math.sin((a*e-c)*2*Math.PI/g)+b;
        return h*Math.pow(2,-10*(a-=1))*Math.sin((a*e-c)*2*Math.PI/g)*0.5+d+b
        },
    easeInBack:function(c,a,b,d,e,g){
        if(g==j)g=1.70158;
        return d*(a/=e)*a*((g+1)*a-g)+b
        },
    easeOutBack:function(c,a,b,d,e,g){
        if(g==j)g=1.70158;
        return d*((a=a/e-1)*a*((g+1)*a+g)+1)+b
        },
    easeInOutBack:function(c,a,b,d,e,g){
        if(g==j)g=1.70158;
        if((a/=e/2)<1)return d/2*a*a*(((g*=1.525)+1)*a-g)+b;
        return d/2*((a-=2)*a*(((g*=1.525)+1)*a+g)+2)+b
        },
    easeInBounce:function(c,a,b,d,e){
        return d-f.easing.easeOutBounce(c,e-a,0,d,e)+b
        },
    easeOutBounce:function(c,a,b,d,e){
        return(a/=e)<1/2.75?d*7.5625*a*a+b:a<2/2.75?d*(7.5625*(a-=1.5/2.75)*a+0.75)+b:a<2.5/2.75?d*(7.5625*(a-=2.25/2.75)*a+0.9375)+b:d*(7.5625*(a-=2.625/2.75)*a+0.984375)+b
        },
    easeInOutBounce:function(c,a,b,d,e){
        if(a<e/2)return f.easing.easeInBounce(c,a*2,0,d,e)*0.5+b;
        return f.easing.easeOutBounce(c,
            a*2-e,0,d,e)*0.5+d*0.5+b
        }
    })
}(jQuery);

(function(c){
    c.effects.slide=function(d){
        return this.queue(function(){
            var a=c(this),h=["position","top","bottom","left","right"],f=c.effects.setMode(a,d.options.mode||"show"),b=d.options.direction||"left";
            c.effects.save(a,h);
            a.show();
            c.effects.createWrapper(a).css({
                overflow:"hidden"
            });
            var g=b=="up"||b=="down"?"top":"left";
            b=b=="up"||b=="left"?"pos":"neg";
            var e=d.options.distance||(g=="top"?a.outerHeight({
                margin:true
            }):a.outerWidth({
                margin:true
            }));
            if(f=="show")a.css(g,b=="pos"?isNaN(e)?"-"+e:-e:e);
            var i={};

            i[g]=(f=="show"?b=="pos"?"+=":"-=":b=="pos"?"-=":"+=")+e;
            a.animate(i,{
                queue:false,
                duration:d.duration,
                easing:d.options.easing,
                complete:function(){
                    f=="hide"&&a.hide();
                    c.effects.restore(a,h);
                    c.effects.removeWrapper(a);
                    d.callback&&d.callback.apply(this,arguments);
                    a.dequeue()
                    }
                })
        })
    }
})(jQuery);

(function(b){
    var d=false;
    b(document).mouseup(function(){
        d=false
        });
    b.widget("ui.mouse",{
        options:{
            cancel:":input,option",
            distance:1,
            delay:0
        },
        _mouseInit:function(){
            var a=this;
            this.element.bind("mousedown."+this.widgetName,function(c){
                return a._mouseDown(c)
                }).bind("click."+this.widgetName,function(c){
                if(true===b.data(c.target,a.widgetName+".preventClickEvent")){
                    b.removeData(c.target,a.widgetName+".preventClickEvent");
                    c.stopImmediatePropagation();
                    return false
                    }
                });
        this.started=false
        },
    _mouseDestroy:function(){
        this.element.unbind("."+
            this.widgetName)
        },
    _mouseDown:function(a){
        if(!d){
            this._mouseStarted&&this._mouseUp(a);
            this._mouseDownEvent=a;
            var c=this,f=a.which==1,g=typeof this.options.cancel=="string"&&a.target.nodeName?b(a.target).closest(this.options.cancel).length:false;
            if(!f||g||!this._mouseCapture(a))return true;
            this.mouseDelayMet=!this.options.delay;
            if(!this.mouseDelayMet)this._mouseDelayTimer=setTimeout(function(){
                c.mouseDelayMet=true
                },this.options.delay);
            if(this._mouseDistanceMet(a)&&this._mouseDelayMet(a)){
                this._mouseStarted=
                this._mouseStart(a)!==false;
                if(!this._mouseStarted){
                    a.preventDefault();
                    return true
                    }
                }
            true===b.data(a.target,this.widgetName+".preventClickEvent")&&b.removeData(a.target,this.widgetName+".preventClickEvent");
        this._mouseMoveDelegate=function(e){
            return c._mouseMove(e)
            };

        this._mouseUpDelegate=function(e){
            return c._mouseUp(e)
            };

        b(document).bind("mousemove."+this.widgetName,this._mouseMoveDelegate).bind("mouseup."+this.widgetName,this._mouseUpDelegate);
        a.preventDefault();
        return d=true
        }
    },
_mouseMove:function(a){
    if(b.browser.msie&&
        !(document.documentMode>=9)&&!a.button)return this._mouseUp(a);
    if(this._mouseStarted){
        this._mouseDrag(a);
        return a.preventDefault()
        }
        if(this._mouseDistanceMet(a)&&this._mouseDelayMet(a))(this._mouseStarted=this._mouseStart(this._mouseDownEvent,a)!==false)?this._mouseDrag(a):this._mouseUp(a);
    return!this._mouseStarted
    },
_mouseUp:function(a){
    b(document).unbind("mousemove."+this.widgetName,this._mouseMoveDelegate).unbind("mouseup."+this.widgetName,this._mouseUpDelegate);
    if(this._mouseStarted){
        this._mouseStarted=
        false;
        a.target==this._mouseDownEvent.target&&b.data(a.target,this.widgetName+".preventClickEvent",true);
        this._mouseStop(a)
        }
        return false
    },
_mouseDistanceMet:function(a){
    return Math.max(Math.abs(this._mouseDownEvent.pageX-a.pageX),Math.abs(this._mouseDownEvent.pageY-a.pageY))>=this.options.distance
    },
_mouseDelayMet:function(){
    return this.mouseDelayMet
    },
_mouseStart:function(){},
    _mouseDrag:function(){},
    _mouseStop:function(){},
    _mouseCapture:function(){
    return true
    }
})
})(jQuery);


(function(d){
    d.widget("ui.sortable",d.ui.mouse,{
        widgetEventPrefix:"sort",
        options:{
            appendTo:"parent",
            axis:false,
            connectWith:false,
            containment:false,
            cursor:"auto",
            cursorAt:false,
            dropOnEmpty:true,
            forcePlaceholderSize:false,
            forceHelperSize:false,
            grid:false,
            handle:false,
            helper:"original",
            items:"> *",
            opacity:false,
            placeholder:false,
            revert:false,
            scroll:true,
            scrollSensitivity:20,
            scrollSpeed:20,
            scope:"default",
            tolerance:"intersect",
            zIndex:1E3
        },
        _create:function(){
            var a=this.options;
            this.containerCache={};

            this.element.addClass("ui-sortable");
            this.refresh();
            this.floating=this.items.length?a.axis==="x"||/left|right/.test(this.items[0].item.css("float"))||/inline|table-cell/.test(this.items[0].item.css("display")):false;
            this.offset=this.element.offset();
            this._mouseInit()
            },
        destroy:function(){
            this.element.removeClass("ui-sortable ui-sortable-disabled").removeData("sortable").unbind(".sortable");
            this._mouseDestroy();
            for(var a=this.items.length-1;a>=0;a--)this.items[a].item.removeData("sortable-item");
            return this
            },
        _setOption:function(a,b){
            if(a===
                "disabled"){
                this.options[a]=b;
                this.widget()[b?"addClass":"removeClass"]("ui-sortable-disabled")
                }else d.Widget.prototype._setOption.apply(this,arguments)
                },
        _mouseCapture:function(a,b){
            if(this.reverting)return false;
            if(this.options.disabled||this.options.type=="static")return false;
            this._refreshItems(a);
            var c=null,e=this;
            d(a.target).parents().each(function(){
                if(d.data(this,"sortable-item")==e){
                    c=d(this);
                    return false
                    }
                });
        if(d.data(a.target,"sortable-item")==e)c=d(a.target);
        if(!c)return false;
        if(this.options.handle&&
            !b){
            var f=false;
            d(this.options.handle,c).find("*").andSelf().each(function(){
                if(this==a.target)f=true
                    });
            if(!f)return false
                }
                this.currentItem=c;
        this._removeCurrentsFromItems();
        return true
        },
    _mouseStart:function(a,b,c){
        b=this.options;
        var e=this;
        this.currentContainer=this;
        this.refreshPositions();
        this.helper=this._createHelper(a);
        this._cacheHelperProportions();
        this._cacheMargins();
        this.scrollParent=this.helper.scrollParent();
        this.offset=this.currentItem.offset();
        this.offset={
            top:this.offset.top-this.margins.top,
            left:this.offset.left-this.margins.left
            };

        this.helper.css("position","absolute");
        this.cssPosition=this.helper.css("position");
        d.extend(this.offset,{
            click:{
                left:a.pageX-this.offset.left,
                top:a.pageY-this.offset.top
                },
            parent:this._getParentOffset(),
            relative:this._getRelativeOffset()
            });
        this.originalPosition=this._generatePosition(a);
        this.originalPageX=a.pageX;
        this.originalPageY=a.pageY;
        b.cursorAt&&this._adjustOffsetFromHelper(b.cursorAt);
        this.domPosition={
            prev:this.currentItem.prev()[0],
            parent:this.currentItem.parent()[0]
            };
        this.helper[0]!=this.currentItem[0]&&this.currentItem.hide();
        this._createPlaceholder();
        b.containment&&this._setContainment();
        if(b.cursor){
            if(d("body").css("cursor"))this._storedCursor=d("body").css("cursor");
            d("body").css("cursor",b.cursor)
            }
            if(b.opacity){
            if(this.helper.css("opacity"))this._storedOpacity=this.helper.css("opacity");
            this.helper.css("opacity",b.opacity)
            }
            if(b.zIndex){
            if(this.helper.css("zIndex"))this._storedZIndex=this.helper.css("zIndex");
            this.helper.css("zIndex",b.zIndex)
            }
            if(this.scrollParent[0]!=
            document&&this.scrollParent[0].tagName!="HTML")this.overflowOffset=this.scrollParent.offset();
        this._trigger("start",a,this._uiHash());
        this._preserveHelperProportions||this._cacheHelperProportions();
        if(!c)for(c=this.containers.length-1;c>=0;c--)this.containers[c]._trigger("activate",a,e._uiHash(this));
        if(d.ui.ddmanager)d.ui.ddmanager.current=this;
        d.ui.ddmanager&&!b.dropBehaviour&&d.ui.ddmanager.prepareOffsets(this,a);
        this.dragging=true;
        this.helper.addClass("ui-sortable-helper");
        this._mouseDrag(a);
        return true
        },
    _mouseDrag:function(a){
        this.position=this._generatePosition(a);
        this.positionAbs=this._convertPositionTo("absolute");
        if(!this.lastPositionAbs)this.lastPositionAbs=this.positionAbs;
        if(this.options.scroll){
            var b=this.options,c=false;
            if(this.scrollParent[0]!=document&&this.scrollParent[0].tagName!="HTML"){
                if(this.overflowOffset.top+this.scrollParent[0].offsetHeight-a.pageY<b.scrollSensitivity)this.scrollParent[0].scrollTop=c=this.scrollParent[0].scrollTop+b.scrollSpeed;
                else if(a.pageY-this.overflowOffset.top<
                    b.scrollSensitivity)this.scrollParent[0].scrollTop=c=this.scrollParent[0].scrollTop-b.scrollSpeed;
                if(this.overflowOffset.left+this.scrollParent[0].offsetWidth-a.pageX<b.scrollSensitivity)this.scrollParent[0].scrollLeft=c=this.scrollParent[0].scrollLeft+b.scrollSpeed;
                else if(a.pageX-this.overflowOffset.left<b.scrollSensitivity)this.scrollParent[0].scrollLeft=c=this.scrollParent[0].scrollLeft-b.scrollSpeed
                    }else{
                if(a.pageY-d(document).scrollTop()<b.scrollSensitivity)c=d(document).scrollTop(d(document).scrollTop()-
                    b.scrollSpeed);
                else if(d(window).height()-(a.pageY-d(document).scrollTop())<b.scrollSensitivity)c=d(document).scrollTop(d(document).scrollTop()+b.scrollSpeed);
                if(a.pageX-d(document).scrollLeft()<b.scrollSensitivity)c=d(document).scrollLeft(d(document).scrollLeft()-b.scrollSpeed);
                else if(d(window).width()-(a.pageX-d(document).scrollLeft())<b.scrollSensitivity)c=d(document).scrollLeft(d(document).scrollLeft()+b.scrollSpeed)
                    }
                    c!==false&&d.ui.ddmanager&&!b.dropBehaviour&&d.ui.ddmanager.prepareOffsets(this,
                a)
            }
            this.positionAbs=this._convertPositionTo("absolute");
        if(!this.options.axis||this.options.axis!="y")this.helper[0].style.left=this.position.left+"px";
        if(!this.options.axis||this.options.axis!="x")this.helper[0].style.top=this.position.top+"px";
        for(b=this.items.length-1;b>=0;b--){
            c=this.items[b];
            var e=c.item[0],f=this._intersectsWithPointer(c);
            if(f)if(e!=this.currentItem[0]&&this.placeholder[f==1?"next":"prev"]()[0]!=e&&!d.ui.contains(this.placeholder[0],e)&&(this.options.type=="semi-dynamic"?!d.ui.contains(this.element[0],
                e):true)){
                this.direction=f==1?"down":"up";
                if(this.options.tolerance=="pointer"||this._intersectsWithSides(c))this._rearrange(a,c);else break;
                this._trigger("change",a,this._uiHash());
                break
            }
            }
            this._contactContainers(a);
        d.ui.ddmanager&&d.ui.ddmanager.drag(this,a);
        this._trigger("sort",a,this._uiHash());
        this.lastPositionAbs=this.positionAbs;
        return false
        },
    _mouseStop:function(a,b){
        if(a){
            d.ui.ddmanager&&!this.options.dropBehaviour&&d.ui.ddmanager.drop(this,a);
            if(this.options.revert){
                var c=this;
                b=c.placeholder.offset();
                c.reverting=true;
                d(this.helper).animate({
                    left:b.left-this.offset.parent.left-c.margins.left+(this.offsetParent[0]==document.body?0:this.offsetParent[0].scrollLeft),
                    top:b.top-this.offset.parent.top-c.margins.top+(this.offsetParent[0]==document.body?0:this.offsetParent[0].scrollTop)
                    },parseInt(this.options.revert,10)||500,function(){
                    c._clear(a)
                    })
                }else this._clear(a,b);
            return false
            }
        },
cancel:function(){
    var a=this;
    if(this.dragging){
        this._mouseUp({
            target:null
        });
        this.options.helper=="original"?this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper"):
        this.currentItem.show();
        for(var b=this.containers.length-1;b>=0;b--){
            this.containers[b]._trigger("deactivate",null,a._uiHash(this));
            if(this.containers[b].containerCache.over){
                this.containers[b]._trigger("out",null,a._uiHash(this));
                this.containers[b].containerCache.over=0
                }
            }
        }
    if(this.placeholder){
    this.placeholder[0].parentNode&&this.placeholder[0].parentNode.removeChild(this.placeholder[0]);
    this.options.helper!="original"&&this.helper&&this.helper[0].parentNode&&this.helper.remove();
    d.extend(this,{
        helper:null,
        dragging:false,
        reverting:false,
        _noFinalSort:null
    });
    this.domPosition.prev?d(this.domPosition.prev).after(this.currentItem):d(this.domPosition.parent).prepend(this.currentItem)
    }
    return this
},
serialize:function(a){
    var b=this._getItemsAsjQuery(a&&a.connected),c=[];
    a=a||{};

    d(b).each(function(){
        var e=(d(a.item||this).attr(a.attribute||"id")||"").match(a.expression||/(.+)[-=_](.+)/);
        if(e)c.push((a.key||e[1]+"[]")+"="+(a.key&&a.expression?e[1]:e[2]))
            });
    !c.length&&a.key&&c.push(a.key+"=");
    return c.join("&")
    },
toArray:function(a){
    var b=this._getItemsAsjQuery(a&&a.connected),c=[];
    a=a||{};

    b.each(function(){
        c.push(d(a.item||this).attr(a.attribute||"id")||"")
        });
    return c
    },
_intersectsWith:function(a){
    var b=this.positionAbs.left,c=b+this.helperProportions.width,e=this.positionAbs.top,f=e+this.helperProportions.height,g=a.left,h=g+a.width,i=a.top,k=i+a.height,j=this.offset.click.top,l=this.offset.click.left;
    j=e+j>i&&e+j<k&&b+l>g&&b+l<h;
    return this.options.tolerance=="pointer"||this.options.forcePointerForContainers||
    this.options.tolerance!="pointer"&&this.helperProportions[this.floating?"width":"height"]>a[this.floating?"width":"height"]?j:g<b+this.helperProportions.width/2&&c-this.helperProportions.width/2<h&&i<e+this.helperProportions.height/2&&f-this.helperProportions.height/2<k
    },
_intersectsWithPointer:function(a){
    var b=d.ui.isOverAxis(this.positionAbs.top+this.offset.click.top,a.top,a.height);
    a=d.ui.isOverAxis(this.positionAbs.left+this.offset.click.left,a.left,a.width);
    b=b&&a;
    a=this._getDragVerticalDirection();
    var c=this._getDragHorizontalDirection();
    if(!b)return false;
    return this.floating?c&&c=="right"||a=="down"?2:1:a&&(a=="down"?2:1)
    },
_intersectsWithSides:function(a){
    var b=d.ui.isOverAxis(this.positionAbs.top+this.offset.click.top,a.top+a.height/2,a.height);
    a=d.ui.isOverAxis(this.positionAbs.left+this.offset.click.left,a.left+a.width/2,a.width);
    var c=this._getDragVerticalDirection(),e=this._getDragHorizontalDirection();
    return this.floating&&e?e=="right"&&a||e=="left"&&!a:c&&(c=="down"&&b||c=="up"&&!b)
    },
_getDragVerticalDirection:function(){
    var a=this.positionAbs.top-this.lastPositionAbs.top;
    return a!=0&&(a>0?"down":"up")
    },
_getDragHorizontalDirection:function(){
    var a=this.positionAbs.left-this.lastPositionAbs.left;
    return a!=0&&(a>0?"right":"left")
    },
refresh:function(a){
    this._refreshItems(a);
    this.refreshPositions();
    return this
    },
_connectWith:function(){
    var a=this.options;
    return a.connectWith.constructor==String?[a.connectWith]:a.connectWith
    },
_getItemsAsjQuery:function(a){
    var b=[],c=[],e=this._connectWith();
    if(e&&a)for(a=e.length-1;a>=0;a--)for(var f=d(e[a]),g=f.length-1;g>=0;g--){
        var h=d.data(f[g],"sortable");
        if(h&&h!=this&&!h.options.disabled)c.push([d.isFunction(h.options.items)?h.options.items.call(h.element):d(h.options.items,h.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"),h])
            }
            c.push([d.isFunction(this.options.items)?this.options.items.call(this.element,null,{
        options:this.options,
        item:this.currentItem
        }):d(this.options.items,this.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"),
        this]);
    for(a=c.length-1;a>=0;a--)c[a][0].each(function(){
        b.push(this)
        });
    return d(b)
    },
_removeCurrentsFromItems:function(){
    for(var a=this.currentItem.find(":data(sortable-item)"),b=0;b<this.items.length;b++)for(var c=0;c<a.length;c++)a[c]==this.items[b].item[0]&&this.items.splice(b,1)
        },
_refreshItems:function(a){
    this.items=[];
    this.containers=[this];
    var b=this.items,c=[[d.isFunction(this.options.items)?this.options.items.call(this.element[0],a,{
        item:this.currentItem
        }):d(this.options.items,this.element),
    this]],e=this._connectWith();
    if(e)for(var f=e.length-1;f>=0;f--)for(var g=d(e[f]),h=g.length-1;h>=0;h--){
        var i=d.data(g[h],"sortable");
        if(i&&i!=this&&!i.options.disabled){
            c.push([d.isFunction(i.options.items)?i.options.items.call(i.element[0],a,{
                item:this.currentItem
                }):d(i.options.items,i.element),i]);
            this.containers.push(i)
            }
        }
    for(f=c.length-1;f>=0;f--){
    a=c[f][1];
    e=c[f][0];
    h=0;
    for(g=e.length;h<g;h++){
        i=d(e[h]);
        i.data("sortable-item",a);
        b.push({
            item:i,
            instance:a,
            width:0,
            height:0,
            left:0,
            top:0
        })
        }
    }
},
refreshPositions:function(a){
    if(this.offsetParent&&
        this.helper)this.offset.parent=this._getParentOffset();
    for(var b=this.items.length-1;b>=0;b--){
        var c=this.items[b];
        if(!(c.instance!=this.currentContainer&&this.currentContainer&&c.item[0]!=this.currentItem[0])){
            var e=this.options.toleranceElement?d(this.options.toleranceElement,c.item):c.item;
            if(!a){
                c.width=e.outerWidth();
                c.height=e.outerHeight()
                }
                e=e.offset();
            c.left=e.left;
            c.top=e.top
            }
        }
    if(this.options.custom&&this.options.custom.refreshContainers)this.options.custom.refreshContainers.call(this);else for(b=
    this.containers.length-1;b>=0;b--){
    e=this.containers[b].element.offset();
    this.containers[b].containerCache.left=e.left;
    this.containers[b].containerCache.top=e.top;
    this.containers[b].containerCache.width=this.containers[b].element.outerWidth();
    this.containers[b].containerCache.height=this.containers[b].element.outerHeight()
    }
    return this
},
_createPlaceholder:function(a){
    var b=a||this,c=b.options;
    if(!c.placeholder||c.placeholder.constructor==String){
        var e=c.placeholder;
        c.placeholder={
            element:function(){
                var f=
                d(document.createElement(b.currentItem[0].nodeName)).addClass(e||b.currentItem[0].className+" ui-sortable-placeholder").removeClass("ui-sortable-helper")[0];
                if(!e)f.style.visibility="hidden";
                return f
                },
            update:function(f,g){
                if(!(e&&!c.forcePlaceholderSize)){
                    g.height()||g.height(b.currentItem.innerHeight()-parseInt(b.currentItem.css("paddingTop")||0,10)-parseInt(b.currentItem.css("paddingBottom")||0,10));
                    g.width()||g.width(b.currentItem.innerWidth()-parseInt(b.currentItem.css("paddingLeft")||0,10)-parseInt(b.currentItem.css("paddingRight")||
                        0,10))
                    }
                }
        }
}
b.placeholder=d(c.placeholder.element.call(b.element,b.currentItem));
b.currentItem.after(b.placeholder);
c.placeholder.update(b,b.placeholder)
},
_contactContainers:function(a){
    for(var b=null,c=null,e=this.containers.length-1;e>=0;e--)if(!d.ui.contains(this.currentItem[0],this.containers[e].element[0]))if(this._intersectsWith(this.containers[e].containerCache)){
        if(!(b&&d.ui.contains(this.containers[e].element[0],b.element[0]))){
            b=this.containers[e];
            c=e
            }
        }else if(this.containers[e].containerCache.over){
        this.containers[e]._trigger("out",
            a,this._uiHash(this));
        this.containers[e].containerCache.over=0
        }
        if(b)if(this.containers.length===1){
    this.containers[c]._trigger("over",a,this._uiHash(this));
    this.containers[c].containerCache.over=1
    }
    else if(this.currentContainer!=this.containers[c]){
    b=1E4;
    e=null;
    for(var f=this.positionAbs[this.containers[c].floating?"left":"top"],g=this.items.length-1;g>=0;g--)if(d.ui.contains(this.containers[c].element[0],this.items[g].item[0])){
        var h=this.items[g][this.containers[c].floating?"left":"top"];
        if(Math.abs(h-
            f)<b){
            b=Math.abs(h-f);
            e=this.items[g]
            }
        }
    if(e||this.options.dropOnEmpty){
    this.currentContainer=this.containers[c];
    e?this._rearrange(a,e,null,true):this._rearrange(a,null,this.containers[c].element,true);
    this._trigger("change",a,this._uiHash());
    this.containers[c]._trigger("change",a,this._uiHash(this));
    this.options.placeholder.update(this.currentContainer,this.placeholder);
    this.containers[c]._trigger("over",a,this._uiHash(this));
    this.containers[c].containerCache.over=1
    }
}
},
_createHelper:function(a){
    var b=
    this.options;
    a=d.isFunction(b.helper)?d(b.helper.apply(this.element[0],[a,this.currentItem])):b.helper=="clone"?this.currentItem.clone():this.currentItem;
    a.parents("body").length||d(b.appendTo!="parent"?b.appendTo:this.currentItem[0].parentNode)[0].appendChild(a[0]);
    if(a[0]==this.currentItem[0])this._storedCSS={
        width:this.currentItem[0].style.width,
        height:this.currentItem[0].style.height,
        position:this.currentItem.css("position"),
        top:this.currentItem.css("top"),
        left:this.currentItem.css("left")
        };

    if(a[0].style.width==
        ""||b.forceHelperSize)a.width(this.currentItem.width());
    if(a[0].style.height==""||b.forceHelperSize)a.height(this.currentItem.height());
    return a
    },
_adjustOffsetFromHelper:function(a){
    if(typeof a=="string")a=a.split(" ");
    if(d.isArray(a))a={
        left:+a[0],
        top:+a[1]||0
        };

    if("left"in a)this.offset.click.left=a.left+this.margins.left;
    if("right"in a)this.offset.click.left=this.helperProportions.width-a.right+this.margins.left;
    if("top"in a)this.offset.click.top=a.top+this.margins.top;
    if("bottom"in a)this.offset.click.top=
        this.helperProportions.height-a.bottom+this.margins.top
        },
_getParentOffset:function(){
    this.offsetParent=this.helper.offsetParent();
    var a=this.offsetParent.offset();
    if(this.cssPosition=="absolute"&&this.scrollParent[0]!=document&&d.ui.contains(this.scrollParent[0],this.offsetParent[0])){
        a.left+=this.scrollParent.scrollLeft();
        a.top+=this.scrollParent.scrollTop()
        }
        if(this.offsetParent[0]==document.body||this.offsetParent[0].tagName&&this.offsetParent[0].tagName.toLowerCase()=="html"&&d.browser.msie)a=

        {
        top:0,
        left:0
    };

    return{
        top:a.top+(parseInt(this.offsetParent.css("borderTopWidth"),10)||0),
        left:a.left+(parseInt(this.offsetParent.css("borderLeftWidth"),10)||0)
        }
    },
_getRelativeOffset:function(){
    if(this.cssPosition=="relative"){
        var a=this.currentItem.position();
        return{
            top:a.top-(parseInt(this.helper.css("top"),10)||0)+this.scrollParent.scrollTop(),
            left:a.left-(parseInt(this.helper.css("left"),10)||0)+this.scrollParent.scrollLeft()
            }
        }
    else return{
top:0,
        left:0
}
},
_cacheMargins:function(){
this.margins={
left:parseInt(this.currentItem.css("marginLeft"),
    10)||0,
    top:parseInt(this.currentItem.css("marginTop"),10)||0
}
},
_cacheHelperProportions:function(){
this.helperProportions={
width:this.helper.outerWidth(),
    height:this.helper.outerHeight()
}
},
_setContainment:function(){
var a=this.options;if(a.containment=="parent")a.containment=this.helper[0].parentNode;if(a.containment=="document"||a.containment=="window")this.containment=[0-this.offset.relative.left-this.offset.parent.left,0-this.offset.relative.top-this.offset.parent.top,d(a.containment=="document"?
    document:window).width()-this.helperProportions.width-this.margins.left,(d(a.containment=="document"?document:window).height()||document.body.parentNode.scrollHeight)-this.helperProportions.height-this.margins.top];if(!/^(document|window|parent)$/.test(a.containment)){
var b=d(a.containment)[0];a=d(a.containment).offset();var c=d(b).css("overflow")!="hidden";this.containment=[a.left+(parseInt(d(b).css("borderLeftWidth"),10)||0)+(parseInt(d(b).css("paddingLeft"),10)||0)-this.margins.left,a.top+(parseInt(d(b).css("borderTopWidth"),
    10)||0)+(parseInt(d(b).css("paddingTop"),10)||0)-this.margins.top,a.left+(c?Math.max(b.scrollWidth,b.offsetWidth):b.offsetWidth)-(parseInt(d(b).css("borderLeftWidth"),10)||0)-(parseInt(d(b).css("paddingRight"),10)||0)-this.helperProportions.width-this.margins.left,a.top+(c?Math.max(b.scrollHeight,b.offsetHeight):b.offsetHeight)-(parseInt(d(b).css("borderTopWidth"),10)||0)-(parseInt(d(b).css("paddingBottom"),10)||0)-this.helperProportions.height-this.margins.top]
}
},
_convertPositionTo:function(a,b){
if(!b)b=
this.position;a=a=="absolute"?1:-1;var c=this.cssPosition=="absolute"&&!(this.scrollParent[0]!=document&&d.ui.contains(this.scrollParent[0],this.offsetParent[0]))?this.offsetParent:this.scrollParent,e=/(html|body)/i.test(c[0].tagName);return{
top:b.top+this.offset.relative.top*a+this.offset.parent.top*a-(d.browser.safari&&this.cssPosition=="fixed"?0:(this.cssPosition=="fixed"?-this.scrollParent.scrollTop():e?0:c.scrollTop())*a),
    left:b.left+this.offset.relative.left*a+this.offset.parent.left*a-(d.browser.safari&&
    this.cssPosition=="fixed"?0:(this.cssPosition=="fixed"?-this.scrollParent.scrollLeft():e?0:c.scrollLeft())*a)
}
},
_generatePosition:function(a){
var b=this.options,c=this.cssPosition=="absolute"&&!(this.scrollParent[0]!=document&&d.ui.contains(this.scrollParent[0],this.offsetParent[0]))?this.offsetParent:this.scrollParent,e=/(html|body)/i.test(c[0].tagName);if(this.cssPosition=="relative"&&!(this.scrollParent[0]!=document&&this.scrollParent[0]!=this.offsetParent[0]))this.offset.relative=this._getRelativeOffset();
var f=a.pageX,g=a.pageY;if(this.originalPosition){
if(this.containment){
if(a.pageX-this.offset.click.left<this.containment[0])f=this.containment[0]+this.offset.click.left;if(a.pageY-this.offset.click.top<this.containment[1])g=this.containment[1]+this.offset.click.top;if(a.pageX-this.offset.click.left>this.containment[2])f=this.containment[2]+this.offset.click.left;if(a.pageY-this.offset.click.top>this.containment[3])g=this.containment[3]+this.offset.click.top
}
if(b.grid){
g=this.originalPageY+Math.round((g-
    this.originalPageY)/b.grid[1])*b.grid[1];g=this.containment?!(g-this.offset.click.top<this.containment[1]||g-this.offset.click.top>this.containment[3])?g:!(g-this.offset.click.top<this.containment[1])?g-b.grid[1]:g+b.grid[1]:g;f=this.originalPageX+Math.round((f-this.originalPageX)/b.grid[0])*b.grid[0];f=this.containment?!(f-this.offset.click.left<this.containment[0]||f-this.offset.click.left>this.containment[2])?f:!(f-this.offset.click.left<this.containment[0])?f-b.grid[0]:f+b.grid[0]:f
}
}
return{
top:g-
this.offset.click.top-this.offset.relative.top-this.offset.parent.top+(d.browser.safari&&this.cssPosition=="fixed"?0:this.cssPosition=="fixed"?-this.scrollParent.scrollTop():e?0:c.scrollTop()),
    left:f-this.offset.click.left-this.offset.relative.left-this.offset.parent.left+(d.browser.safari&&this.cssPosition=="fixed"?0:this.cssPosition=="fixed"?-this.scrollParent.scrollLeft():e?0:c.scrollLeft())
}
},
_rearrange:function(a,b,c,e){
c?c[0].appendChild(this.placeholder[0]):b.item[0].parentNode.insertBefore(this.placeholder[0],
    this.direction=="down"?b.item[0]:b.item[0].nextSibling);this.counter=this.counter?++this.counter:1;var f=this,g=this.counter;window.setTimeout(function(){
    g==f.counter&&f.refreshPositions(!e)
    },0)
},
_clear:function(a,b){
this.reverting=false;var c=[];!this._noFinalSort&&this.currentItem.parent().length&&this.placeholder.before(this.currentItem);this._noFinalSort=null;if(this.helper[0]==this.currentItem[0]){
for(var e in this._storedCSS)if(this._storedCSS[e]=="auto"||this._storedCSS[e]=="static")this._storedCSS[e]=
"";this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper")
}
else this.currentItem.show();this.fromOutside&&!b&&c.push(function(f){
    this._trigger("receive",f,this._uiHash(this.fromOutside))
    });if((this.fromOutside||this.domPosition.prev!=this.currentItem.prev().not(".ui-sortable-helper")[0]||this.domPosition.parent!=this.currentItem.parent()[0])&&!b)c.push(function(f){
    this._trigger("update",f,this._uiHash())
    });if(!d.ui.contains(this.element[0],this.currentItem[0])){
b||c.push(function(f){
    this._trigger("remove",
        f,this._uiHash())
    });for(e=this.containers.length-1;e>=0;e--)if(d.ui.contains(this.containers[e].element[0],this.currentItem[0])&&!b){
c.push(function(f){
    return function(g){
    f._trigger("receive",g,this._uiHash(this))
    }
}.call(this,this.containers[e]));c.push(function(f){
    return function(g){
    f._trigger("update",g,this._uiHash(this))
    }
}.call(this,this.containers[e]))
}
}
for(e=this.containers.length-1;e>=0;e--){
b||c.push(function(f){
    return function(g){
    f._trigger("deactivate",g,this._uiHash(this))
    }
}.call(this,
    this.containers[e]));if(this.containers[e].containerCache.over){
c.push(function(f){
    return function(g){
    f._trigger("out",g,this._uiHash(this))
    }
}.call(this,this.containers[e]));this.containers[e].containerCache.over=0
}
}
this._storedCursor&&d("body").css("cursor",this._storedCursor);this._storedOpacity&&this.helper.css("opacity",this._storedOpacity);if(this._storedZIndex)this.helper.css("zIndex",this._storedZIndex=="auto"?"":this._storedZIndex);this.dragging=false;if(this.cancelHelperRemoval){
if(!b){
this._trigger("beforeStop",
    a,this._uiHash());for(e=0;e<c.length;e++)c[e].call(this,a);this._trigger("stop",a,this._uiHash())
}
return false
}
b||this._trigger("beforeStop",a,this._uiHash());this.placeholder[0].parentNode.removeChild(this.placeholder[0]);this.helper[0]!=this.currentItem[0]&&this.helper.remove();this.helper=null;if(!b){
for(e=0;e<c.length;e++)c[e].call(this,a);this._trigger("stop",a,this._uiHash())
}
this.fromOutside=false;return true
},
_trigger:function(){
d.Widget.prototype._trigger.apply(this,arguments)===false&&this.cancel()
},
_uiHash:function(a){
var b=a||this;return{
helper:b.helper,
    placeholder:b.placeholder||d([]),
    position:b.position,
    originalPosition:b.originalPosition,
    offset:b.positionAbs,
    item:b.currentItem,
    sender:a?a.element:null
}
}
});d.extend(d.ui.sortable,{
    version:"1.8.16"
    })
})(jQuery);

/*
                                                     * File:        jquery.dataTables.min.js
                                                     * Version:     1.8.2
                                                     * Author:      Allan Jardine (www.sprymedia.co.uk)
                                                     * Info:        www.datatables.net
                                                     *
                                                     * Copyright 2008-2011 Allan Jardine, all rights reserved.
                                                     *
                                                     * This source file is free software, under either the GPL v2 license or a
                                                     * BSD style license, as supplied with this software.
                                                     *
                                                     * This source file is distributed in the hope that it will be useful, but
                                                     * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
                                                     * or FITNESS FOR A PARTICULAR PURPOSE. See the license files for details.
                                                     */
(function(i,za,p){
    i.fn.dataTableSettings=[];
    var D=i.fn.dataTableSettings;
    i.fn.dataTableExt={};

    var n=i.fn.dataTableExt;
    n.sVersion="1.8.2";
    n.sErrMode="alert";
    n.iApiIndex=0;
    n.oApi={};

    n.afnFiltering=[];
    n.aoFeatures=[];
    n.ofnSearch={};

    n.afnSortData=[];
    n.oStdClasses={
    sPagePrevEnabled:"paginate_enabled_previous",
    sPagePrevDisabled:"paginate_disabled_previous",
    sPageNextEnabled:"paginate_enabled_next",
    sPageNextDisabled:"paginate_disabled_next",
    sPageJUINext:"",
    sPageJUIPrev:"",
    sPageButton:"paginate_button",
    sPageButtonActive:"paginate_active",
    sPageButtonStaticDisabled:"paginate_button paginate_button_disabled",
    sPageFirst:"first",
    sPagePrevious:"previous",
    sPageNext:"next",
    sPageLast:"last",
    sStripeOdd:"odd",
    sStripeEven:"even",
    sRowEmpty:"dataTables_empty",
    sWrapper:"dataTables_wrapper",
    sFilter:"dataTables_filter",
    sInfo:"dataTables_info",
    sPaging:"dataTables_paginate paging_",
    sLength:"dataTables_length",
    sProcessing:"dataTables_processing",
    sSortAsc:"sorting_asc",
    sSortDesc:"sorting_desc",
    sSortable:"sorting",
    sSortableAsc:"sorting_asc_disabled",
    sSortableDesc:"sorting_desc_disabled",
    sSortableNone:"sorting_disabled",
    sSortColumn:"sorting_",
    sSortJUIAsc:"",
    sSortJUIDesc:"",
    sSortJUI:"",
    sSortJUIAscAllowed:"",
    sSortJUIDescAllowed:"",
    sSortJUIWrapper:"",
    sSortIcon:"",
    sScrollWrapper:"dataTables_scroll",
    sScrollHead:"dataTables_scrollHead",
    sScrollHeadInner:"dataTables_scrollHeadInner",
    sScrollBody:"dataTables_scrollBody",
    sScrollFoot:"dataTables_scrollFoot",
    sScrollFootInner:"dataTables_scrollFootInner",
    sFooterTH:""
    };

    n.oJUIClasses={
    sPagePrevEnabled:"fg-button ui-button ui-state-default ui-corner-left",
    sPagePrevDisabled:"fg-button ui-button ui-state-default ui-corner-left ui-state-disabled",
    sPageNextEnabled:"fg-button ui-button ui-state-default ui-corner-right",
    sPageNextDisabled:"fg-button ui-button ui-state-default ui-corner-right ui-state-disabled",
    sPageJUINext:"ui-icon ui-icon-circle-arrow-e",
    sPageJUIPrev:"ui-icon ui-icon-circle-arrow-w",
    sPageButton:"fg-button ui-button ui-state-default",
    sPageButtonActive:"fg-button ui-button ui-state-default ui-state-disabled",
    sPageButtonStaticDisabled:"fg-button ui-button ui-state-default ui-state-disabled",
    sPageFirst:"first ui-corner-tl ui-corner-bl",
    sPagePrevious:"previous",
    sPageNext:"next",
    sPageLast:"last ui-corner-tr ui-corner-br",
    sStripeOdd:"odd",
    sStripeEven:"even",
    sRowEmpty:"dataTables_empty",
    sWrapper:"dataTables_wrapper",
    sFilter:"dataTables_filter",
    sInfo:"dataTables_info",
    sPaging:"dataTables_paginate fg-buttonset ui-buttonset fg-buttonset-multi ui-buttonset-multi paging_",
    sLength:"dataTables_length",
    sProcessing:"dataTables_processing",
    sSortAsc:"ui-state-default",
    sSortDesc:"ui-state-default",
    sSortable:"ui-state-default",
    sSortableAsc:"ui-state-default",
    sSortableDesc:"ui-state-default",
    sSortableNone:"ui-state-default",
    sSortColumn:"sorting_",
    sSortJUIAsc:"css_right ui-icon ui-icon-triangle-1-n",
    sSortJUIDesc:"css_right ui-icon ui-icon-triangle-1-s",
    sSortJUI:"css_right ui-icon ui-icon-carat-2-n-s",
    sSortJUIAscAllowed:"css_right ui-icon ui-icon-carat-1-n",
    sSortJUIDescAllowed:"css_right ui-icon ui-icon-carat-1-s",
    sSortJUIWrapper:"DataTables_sort_wrapper",
    sSortIcon:"DataTables_sort_icon",
    sScrollWrapper:"dataTables_scroll",
    sScrollHead:"dataTables_scrollHead ui-state-default",
    sScrollHeadInner:"dataTables_scrollHeadInner",
    sScrollBody:"dataTables_scrollBody",
    sScrollFoot:"dataTables_scrollFoot ui-state-default",
    sScrollFootInner:"dataTables_scrollFootInner",
    sFooterTH:"ui-state-default"
    };

    n.oPagination={
    two_button:{
    fnInit:function(g,l,s){
    var t,w,y;
    if(g.bJUI){
    t=p.createElement("a");
    w=p.createElement("a");
    y=p.createElement("span");
    y.className=g.oClasses.sPageJUINext;
    w.appendChild(y);
    y=p.createElement("span");
    y.className=g.oClasses.sPageJUIPrev;
    t.appendChild(y)
    }else{
    t=p.createElement("div");
    w=p.createElement("div")
    }
    t.className=g.oClasses.sPagePrevDisabled;
    w.className=g.oClasses.sPageNextDisabled;
    t.title=g.oLanguage.oPaginate.sPrevious;
    w.title=g.oLanguage.oPaginate.sNext;
    l.appendChild(t);
    l.appendChild(w);
    i(t).bind("click.DT",function(){
        g.oApi._fnPageChange(g,"previous")&&s(g)
        });
    i(w).bind("click.DT",function(){
        g.oApi._fnPageChange(g,"next")&&s(g)
        });
    i(t).bind("selectstart.DT",function(){
        return false
        });
    i(w).bind("selectstart.DT",function(){
        return false
        });
    if(g.sTableId!==""&&typeof g.aanFeatures.p=="undefined"){
    l.setAttribute("id",g.sTableId+"_paginate");
    t.setAttribute("id",g.sTableId+"_previous");
    w.setAttribute("id",g.sTableId+"_next")
    }
    },
    fnUpdate:function(g){
    if(g.aanFeatures.p)for(var l=g.aanFeatures.p,s=0,t=l.length;s<t;s++)if(l[s].childNodes.length!==0){
    l[s].childNodes[0].className=g._iDisplayStart===0?g.oClasses.sPagePrevDisabled:g.oClasses.sPagePrevEnabled;
    l[s].childNodes[1].className=g.fnDisplayEnd()==g.fnRecordsDisplay()?g.oClasses.sPageNextDisabled:
    g.oClasses.sPageNextEnabled
    }
    }
    },
    iFullNumbersShowPages:5,
    full_numbers:{
    fnInit:function(g,l,s){
    var t=p.createElement("span"),w=p.createElement("span"),y=p.createElement("span"),F=p.createElement("span"),x=p.createElement("span");
    t.innerHTML=g.oLanguage.oPaginate.sFirst;
    w.innerHTML=g.oLanguage.oPaginate.sPrevious;
    F.innerHTML=g.oLanguage.oPaginate.sNext;
    x.innerHTML=g.oLanguage.oPaginate.sLast;
    var v=g.oClasses;
    t.className=v.sPageButton+" "+v.sPageFirst;
    w.className=v.sPageButton+" "+v.sPagePrevious;
    F.className=
    v.sPageButton+" "+v.sPageNext;
    x.className=v.sPageButton+" "+v.sPageLast;
    l.appendChild(t);
    l.appendChild(w);
    l.appendChild(y);
    l.appendChild(F);
    l.appendChild(x);
    i(t).bind("click.DT",function(){
        g.oApi._fnPageChange(g,"first")&&s(g)
        });
    i(w).bind("click.DT",function(){
        g.oApi._fnPageChange(g,"previous")&&s(g)
        });
    i(F).bind("click.DT",function(){
        g.oApi._fnPageChange(g,"next")&&s(g)
        });
    i(x).bind("click.DT",function(){
        g.oApi._fnPageChange(g,"last")&&s(g)
        });
    i("span",l).bind("mousedown.DT",function(){
        return false
        }).bind("selectstart.DT",
        function(){
        return false
        });
    if(g.sTableId!==""&&typeof g.aanFeatures.p=="undefined"){
    l.setAttribute("id",g.sTableId+"_paginate");
    t.setAttribute("id",g.sTableId+"_first");
    w.setAttribute("id",g.sTableId+"_previous");
    F.setAttribute("id",g.sTableId+"_next");
    x.setAttribute("id",g.sTableId+"_last")
    }
    },
    fnUpdate:function(g,l){
    if(g.aanFeatures.p){
    var s=n.oPagination.iFullNumbersShowPages,t=Math.floor(s/2),w=Math.ceil(g.fnRecordsDisplay()/g._iDisplayLength),y=Math.ceil(g._iDisplayStart/g._iDisplayLength)+1,F=
    "",x,v=g.oClasses;
    if(w<s){
    t=1;
    x=w
    }else if(y<=t){
    t=1;
    x=s
}else if(y>=w-t){
    t=w-s+1;
    x=w
}else{
    t=y-Math.ceil(s/2)+1;
    x=t+s-1
}
for(s=t;s<=x;s++)F+=y!=s?'<span class="'+v.sPageButton+'">'+s+"</span>":'<span class="'+v.sPageButtonActive+'">'+s+"</span>";
    x=g.aanFeatures.p;
    var z,$=function(M){
        g._iDisplayStart=(this.innerHTML*1-1)*g._iDisplayLength;
        l(g);
        M.preventDefault()
    },X=function(){
        return false
    };

    s=0;
    for(t=x.length;s<t;s++)if(x[s].childNodes.length!==0){
        z=i("span:eq(2)",x[s]);
        z.html(F);
        i("span",z).bind("click.DT",
            $).bind("mousedown.DT",X).bind("selectstart.DT",X);
        z=x[s].getElementsByTagName("span");
        z=[z[0],z[1],z[z.length-2],z[z.length-1]];
        i(z).removeClass(v.sPageButton+" "+v.sPageButtonActive+" "+v.sPageButtonStaticDisabled);
        if(y==1){
            z[0].className+=" "+v.sPageButtonStaticDisabled;
            z[1].className+=" "+v.sPageButtonStaticDisabled
        }else{
            z[0].className+=" "+v.sPageButton;
            z[1].className+=" "+v.sPageButton
        }
        if(w===0||y==w||g._iDisplayLength==-1){
            z[2].className+=" "+v.sPageButtonStaticDisabled;
            z[3].className+=" "+
            v.sPageButtonStaticDisabled
        }else{
            z[2].className+=" "+v.sPageButton;
            z[3].className+=" "+v.sPageButton
        }
    }
}
}
}
};

n.oSort={
    "string-asc":function(g,l){
        if(typeof g!="string")g="";
        if(typeof l!="string")l="";
        g=g.toLowerCase();
        l=l.toLowerCase();
        return g<l?-1:g>l?1:0
    },
    "string-desc":function(g,l){
        if(typeof g!="string")g="";
        if(typeof l!="string")l="";
        g=g.toLowerCase();
        l=l.toLowerCase();
        return g<l?1:g>l?-1:0
    },
    "html-asc":function(g,l){
        g=g.replace(/<.*?>/g,"").toLowerCase();
        l=l.replace(/<.*?>/g,"").toLowerCase();
        return g<
        l?-1:g>l?1:0
    },
    "html-desc":function(g,l){
        g=g.replace(/<.*?>/g,"").toLowerCase();
        l=l.replace(/<.*?>/g,"").toLowerCase();
        return g<l?1:g>l?-1:0
    },
    "date-asc":function(g,l){
        g=Date.parse(g);
        l=Date.parse(l);
        if(isNaN(g)||g==="")g=Date.parse("01/01/1970 00:00:00");
        if(isNaN(l)||l==="")l=Date.parse("01/01/1970 00:00:00");
        return g-l
    },
    "date-desc":function(g,l){
        g=Date.parse(g);
        l=Date.parse(l);
        if(isNaN(g)||g==="")g=Date.parse("01/01/1970 00:00:00");
        if(isNaN(l)||l==="")l=Date.parse("01/01/1970 00:00:00");
        return l-
        g
    },
    "numeric-asc":function(g,l){
        return(g=="-"||g===""?0:g*1)-(l=="-"||l===""?0:l*1)
    },
    "numeric-desc":function(g,l){
        return(l=="-"||l===""?0:l*1)-(g=="-"||g===""?0:g*1)
    }
};

n.aTypes=[function(g){
    if(typeof g=="number")return"numeric";
    else if(typeof g!="string")return null;
    var l,s=false;
    l=g.charAt(0);
    if("0123456789-".indexOf(l)==-1)return null;
    for(var t=1;t<g.length;t++){
        l=g.charAt(t);
        if("0123456789.".indexOf(l)==-1)return null;
        if(l=="."){
            if(s)return null;
            s=true
        }
    }
    return"numeric"
},function(g){
    var l=Date.parse(g);
    if(l!==null&&!isNaN(l)||typeof g=="string"&&g.length===0)return"date";
    return null
},function(g){
    if(typeof g=="string"&&g.indexOf("<")!=-1&&g.indexOf(">")!=-1)return"html";
    return null
}];
n.fnVersionCheck=function(g){
    var l=function(x,v){
        for(;x.length<v;)x+="0";
        return x
    },s=n.sVersion.split(".");
    g=g.split(".");
    for(var t="",w="",y=0,F=g.length;y<F;y++){
        t+=l(s[y],3);
        w+=l(g[y],3)
    }
    return parseInt(t,10)>=parseInt(w,10)
};

n._oExternConfig={
    iNextUnique:0
};

i.fn.dataTable=function(g){
    function l(){
        this.fnRecordsTotal=
        function(){
            return this.oFeatures.bServerSide?parseInt(this._iRecordsTotal,10):this.aiDisplayMaster.length
        };

        this.fnRecordsDisplay=function(){
            return this.oFeatures.bServerSide?parseInt(this._iRecordsDisplay,10):this.aiDisplay.length
        };

        this.fnDisplayEnd=function(){
            return this.oFeatures.bServerSide?this.oFeatures.bPaginate===false||this._iDisplayLength==-1?this._iDisplayStart+this.aiDisplay.length:Math.min(this._iDisplayStart+this._iDisplayLength,this._iRecordsDisplay):this._iDisplayEnd
        };

        this.sInstance=
        this.oInstance=null;
        this.oFeatures={
            bPaginate:true,
            bLengthChange:true,
            bFilter:true,
            bSort:true,
            bInfo:true,
            bAutoWidth:true,
            bProcessing:false,
            bSortClasses:true,
            bStateSave:false,
            bServerSide:false,
            bDeferRender:false
        };

        this.oScroll={
            sX:"",
            sXInner:"",
            sY:"",
            bCollapse:false,
            bInfinite:false,
            iLoadGap:100,
            iBarWidth:0,
            bAutoCss:true
        };

        this.aanFeatures=[];
        this.oLanguage={
            sProcessing:"Processing...",
            sLengthMenu:"Show _MENU_ entries",
            sZeroRecords:"No matching records found",
            sEmptyTable:"No data available in table",
            sLoadingRecords:"Loading...",
            sInfo:"Showing _START_ to _END_ of _TOTAL_ entries",
            sInfoEmpty:"Showing 0 to 0 of 0 entries",
            sInfoFiltered:"(filtered from _MAX_ total entries)",
            sInfoPostFix:"",
            sInfoThousands:",",
            sSearch:"Search:",
            sUrl:"",
            oPaginate:{
                sFirst:"First",
                sPrevious:"Previous",
                sNext:"Next",
                sLast:"Last"
            },
            fnInfoCallback:null
        };

        this.aoData=[];
        this.aiDisplay=[];
        this.aiDisplayMaster=[];
        this.aoColumns=[];
        this.aoHeader=[];
        this.aoFooter=[];
        this.iNextId=0;
        this.asDataSearch=[];
        this.oPreviousSearch={
            sSearch:"",
            bRegex:false,
            bSmart:true
        };

        this.aoPreSearchCols=[];
        this.aaSorting=[];
        this.aaSortingFixed=null;
        this.asStripeClasses=[];
        this.asDestroyStripes=[];
        this.sDestroyWidth=0;
        this.fnFooterCallback=this.fnHeaderCallback=this.fnRowCallback=null;
        this.aoDrawCallback=[];
        this.fnInitComplete=this.fnPreDrawCallback=null;
        this.sTableId="";
        this.nTableWrapper=this.nTBody=this.nTFoot=this.nTHead=this.nTable=null;
        this.bInitialised=this.bDeferLoading=false;
        this.aoOpenRows=[];
        this.sDom="lfrtip";
        this.sPaginationType=
        "two_button";
        this.iCookieDuration=7200;
        this.sCookiePrefix="SpryMedia_DataTables_";
        this.fnCookieCallback=null;
        this.aoStateSave=[];
        this.aoStateLoad=[];
        this.sAjaxSource=this.oLoadedState=null;
        this.sAjaxDataProp="aaData";
        this.bAjaxDataGet=true;
        this.jqXHR=null;
        this.fnServerData=function(a,b,c,d){
            d.jqXHR=i.ajax({
                url:a,
                data:b,
                success:function(f){
                    i(d.oInstance).trigger("xhr",d);
                    c(f)
                },
                dataType:"json",
                cache:false,
                error:function(f,e){
                    e=="parsererror"&&alert("DataTables warning: JSON data from server could not be parsed. This is caused by a JSON formatting error.")
                }
            })
        };
        this.aoServerParams=[];
        this.fnFormatNumber=function(a){
            if(a<1E3)return a;
            else{
                var b=a+"";
                a=b.split("");
                var c="";
                b=b.length;
                for(var d=0;d<b;d++){
                    if(d%3===0&&d!==0)c=this.oLanguage.sInfoThousands+c;
                    c=a[b-d-1]+c
                }
            }
            return c
        };

        this.aLengthMenu=[10,20,40,100,1000,2000,10000];
        this.bDrawing=this.iDraw=0;
        this.iDrawError=-1;
        this._iDisplayLength=10000;
        this._iDisplayStart=0;
        this._iDisplayEnd=10;
        this._iRecordsDisplay=this._iRecordsTotal=0;
        this.bJUI=false;
        this.oClasses=n.oStdClasses;
        this.bSortCellsTop=this.bSorted=this.bFiltered=false;
        this.oInit=null;
        this.aoDestroyCallback=[]
    }
    function s(a){
        return function(){
            var b=[A(this[n.iApiIndex])].concat(Array.prototype.slice.call(arguments));
            return n.oApi[a].apply(this,b)
        }
    }
    function t(a){
        var b,c,d=a.iInitDisplayStart;
        if(a.bInitialised===false)setTimeout(function(){
            t(a)
        },200);
        else{
            Aa(a);
            X(a);
            M(a,a.aoHeader);
            a.nTFoot&&M(a,a.aoFooter);
            K(a,true);
            a.oFeatures.bAutoWidth&&ga(a);
            b=0;
            for(c=a.aoColumns.length;b<c;b++)if(a.aoColumns[b].sWidth!==null)a.aoColumns[b].nTh.style.width=q(a.aoColumns[b].sWidth);
            if(a.oFeatures.bSort)R(a);
            else if(a.oFeatures.bFilter)N(a,a.oPreviousSearch);
            else{
                a.aiDisplay=a.aiDisplayMaster.slice();
                E(a);
                C(a)
            }
            if(a.sAjaxSource!==null&&!a.oFeatures.bServerSide){
                c=[];
                ha(a,c);
                a.fnServerData.call(a.oInstance,a.sAjaxSource,c,function(f){
                    var e=f;
                    if(a.sAjaxDataProp!=="")e=aa(a.sAjaxDataProp)(f);
                    for(b=0;b<e.length;b++)v(a,e[b]);
                    a.iInitDisplayStart=d;
                    if(a.oFeatures.bSort)R(a);
                    else{
                        a.aiDisplay=a.aiDisplayMaster.slice();
                        E(a);
                        C(a)
                    }
                    K(a,false);
                    w(a,f)
                },a)
            }else if(!a.oFeatures.bServerSide){
                K(a,
                    false);
                w(a)
            }
        }
    }
    function w(a,b){
        a._bInitComplete=true;
        if(typeof a.fnInitComplete=="function")typeof b!="undefined"?a.fnInitComplete.call(a.oInstance,a,b):a.fnInitComplete.call(a.oInstance,a)
    }
    function y(a,b,c){
        a.oLanguage=i.extend(true,a.oLanguage,b);
        typeof b.sEmptyTable=="undefined"&&typeof b.sZeroRecords!="undefined"&&o(a.oLanguage,b,"sZeroRecords","sEmptyTable");
        typeof b.sLoadingRecords=="undefined"&&typeof b.sZeroRecords!="undefined"&&o(a.oLanguage,b,"sZeroRecords","sLoadingRecords");
        c&&t(a)
    }
    function F(a,
        b){
        var c=a.aoColumns.length;
        b={
            sType:null,
            _bAutoType:true,
            bVisible:true,
            bSearchable:true,
            bSortable:true,
            asSorting:["asc","desc"],
            sSortingClass:a.oClasses.sSortable,
            sSortingClassJUI:a.oClasses.sSortJUI,
            sTitle:b?b.innerHTML:"",
            sName:"",
            sWidth:null,
            sWidthOrig:null,
            sClass:null,
            fnRender:null,
            bUseRendered:true,
            iDataSort:c,
            mDataProp:c,
            fnGetData:null,
            fnSetData:null,
            sSortDataType:"std",
            sDefaultContent:null,
            sContentPadding:"",
            nTh:b?b:p.createElement("th"),
            nTf:null
        };

        a.aoColumns.push(b);
        if(typeof a.aoPreSearchCols[c]==
            "undefined"||a.aoPreSearchCols[c]===null)a.aoPreSearchCols[c]={
            sSearch:"",
            bRegex:false,
            bSmart:true
        };
        else{
            if(typeof a.aoPreSearchCols[c].bRegex=="undefined")a.aoPreSearchCols[c].bRegex=true;
            if(typeof a.aoPreSearchCols[c].bSmart=="undefined")a.aoPreSearchCols[c].bSmart=true
        }
        x(a,c,null)
    }
    function x(a,b,c){
        b=a.aoColumns[b];
        if(typeof c!="undefined"&&c!==null){
            if(typeof c.sType!="undefined"){
                b.sType=c.sType;
                b._bAutoType=false
            }
            o(b,c,"bVisible");
            o(b,c,"bSearchable");
            o(b,c,"bSortable");
            o(b,c,"sTitle");
            o(b,
                c,"sName");
            o(b,c,"sWidth");
            o(b,c,"sWidth","sWidthOrig");
            o(b,c,"sClass");
            o(b,c,"fnRender");
            o(b,c,"bUseRendered");
            o(b,c,"iDataSort");
            o(b,c,"mDataProp");
            o(b,c,"asSorting");
            o(b,c,"sSortDataType");
            o(b,c,"sDefaultContent");
            o(b,c,"sContentPadding")
        }
        b.fnGetData=aa(b.mDataProp);
        b.fnSetData=Ba(b.mDataProp);
        if(!a.oFeatures.bSort)b.bSortable=false;
        if(!b.bSortable||i.inArray("asc",b.asSorting)==-1&&i.inArray("desc",b.asSorting)==-1){
            b.sSortingClass=a.oClasses.sSortableNone;
            b.sSortingClassJUI=""
        }else if(b.bSortable||
            i.inArray("asc",b.asSorting)==-1&&i.inArray("desc",b.asSorting)==-1){
            b.sSortingClass=a.oClasses.sSortable;
            b.sSortingClassJUI=a.oClasses.sSortJUI
        }else if(i.inArray("asc",b.asSorting)!=-1&&i.inArray("desc",b.asSorting)==-1){
            b.sSortingClass=a.oClasses.sSortableAsc;
            b.sSortingClassJUI=a.oClasses.sSortJUIAscAllowed
        }else if(i.inArray("asc",b.asSorting)==-1&&i.inArray("desc",b.asSorting)!=-1){
            b.sSortingClass=a.oClasses.sSortableDesc;
            b.sSortingClassJUI=a.oClasses.sSortJUIDescAllowed
        }
    }
    function v(a,b){
        var c;
        c=i.isArray(b)?b.slice():i.extend(true,{},b);
        b=a.aoData.length;
        var d={
            nTr:null,
            _iId:a.iNextId++,
            _aData:c,
            _anHidden:[],
            _sRowStripe:""
        };

        a.aoData.push(d);
        for(var f,e=0,h=a.aoColumns.length;e<h;e++){
            c=a.aoColumns[e];
            typeof c.fnRender=="function"&&c.bUseRendered&&c.mDataProp!==null&&O(a,b,e,c.fnRender({
                iDataRow:b,
                iDataColumn:e,
                aData:d._aData,
                oSettings:a
            }));
            if(c._bAutoType&&c.sType!="string"){
                f=G(a,b,e,"type");
                if(f!==null&&f!==""){
                    f=ia(f);
                    if(c.sType===null)c.sType=f;
                    else if(c.sType!=f&&c.sType!="html")c.sType=
                        "string"
                }
            }
        }
        a.aiDisplayMaster.push(b);
        a.oFeatures.bDeferRender||z(a,b);
        return b
    }
    function z(a,b){
        var c=a.aoData[b],d;
        if(c.nTr===null){
            c.nTr=p.createElement("tr");
            typeof c._aData.DT_RowId!="undefined"&&c.nTr.setAttribute("id",c._aData.DT_RowId);
            typeof c._aData.DT_RowClass!="undefined"&&i(c.nTr).addClass(c._aData.DT_RowClass);
            for(var f=0,e=a.aoColumns.length;f<e;f++){
                var h=a.aoColumns[f];
                d=p.createElement("td");
                d.innerHTML=typeof h.fnRender=="function"&&(!h.bUseRendered||h.mDataProp===null)?h.fnRender({
                    iDataRow:b,
                    iDataColumn:f,
                    aData:c._aData,
                    oSettings:a
                }):G(a,b,f,"display");
                if(h.sClass!==null)d.className=h.sClass;
                if(h.bVisible){
                    c.nTr.appendChild(d);
                    c._anHidden[f]=null
                }else c._anHidden[f]=d
            }
        }
    }
    function $(a){
        var b,c,d,f,e,h,j,k,m;
        if(a.bDeferLoading||a.sAjaxSource===null){
            j=a.nTBody.childNodes;
            b=0;
            for(c=j.length;b<c;b++)if(j[b].nodeName.toUpperCase()=="TR"){
                k=a.aoData.length;
                a.aoData.push({
                    nTr:j[b],
                    _iId:a.iNextId++,
                    _aData:[],
                    _anHidden:[],
                    _sRowStripe:""
                });
                a.aiDisplayMaster.push(k);
                h=j[b].childNodes;
                d=e=0;
                for(f=
                    h.length;d<f;d++){
                    m=h[d].nodeName.toUpperCase();
                    if(m=="TD"||m=="TH"){
                        O(a,k,e,i.trim(h[d].innerHTML));
                        e++
                    }
                }
            }
        }
        j=ba(a);
        h=[];
        b=0;
        for(c=j.length;b<c;b++){
            d=0;
            for(f=j[b].childNodes.length;d<f;d++){
                e=j[b].childNodes[d];
                m=e.nodeName.toUpperCase();
                if(m=="TD"||m=="TH")h.push(e)
            }
        }
        h.length!=j.length*a.aoColumns.length&&J(a,1,"Unexpected number of TD elements. Expected "+j.length*a.aoColumns.length+" and got "+h.length+". DataTables does not support rowspan / colspan in the table body, and there must be one cell for each row/column combination.");
        d=0;
        for(f=a.aoColumns.length;d<f;d++){
            if(a.aoColumns[d].sTitle===null)a.aoColumns[d].sTitle=a.aoColumns[d].nTh.innerHTML;
            j=a.aoColumns[d]._bAutoType;
            m=typeof a.aoColumns[d].fnRender=="function";
            e=a.aoColumns[d].sClass!==null;
            k=a.aoColumns[d].bVisible;
            var u,r;
            if(j||m||e||!k){
                b=0;
                for(c=a.aoData.length;b<c;b++){
                    u=h[b*f+d];
                    if(j&&a.aoColumns[d].sType!="string"){
                        r=G(a,b,d,"type");
                        if(r!==""){
                            r=ia(r);
                            if(a.aoColumns[d].sType===null)a.aoColumns[d].sType=r;
                            else if(a.aoColumns[d].sType!=r&&a.aoColumns[d].sType!=
                                "html")a.aoColumns[d].sType="string"
                        }
                    }
                    if(m){
                        r=a.aoColumns[d].fnRender({
                            iDataRow:b,
                            iDataColumn:d,
                            aData:a.aoData[b]._aData,
                            oSettings:a
                        });
                        u.innerHTML=r;
                        a.aoColumns[d].bUseRendered&&O(a,b,d,r)
                    }
                    if(e)u.className+=" "+a.aoColumns[d].sClass;
                    if(k)a.aoData[b]._anHidden[d]=null;
                    else{
                        a.aoData[b]._anHidden[d]=u;
                        u.parentNode.removeChild(u)
                    }
                }
            }
        }
    }
    function X(a){
        var b,c,d;
        a.nTHead.getElementsByTagName("tr");
        if(a.nTHead.getElementsByTagName("th").length!==0){
            b=0;
            for(d=a.aoColumns.length;b<d;b++){
                c=a.aoColumns[b].nTh;
                a.aoColumns[b].sClass!==null&&i(c).addClass(a.aoColumns[b].sClass);
                if(a.aoColumns[b].sTitle!=c.innerHTML)c.innerHTML=a.aoColumns[b].sTitle
            }
        }else{
            var f=p.createElement("tr");
            b=0;
            for(d=a.aoColumns.length;b<d;b++){
                c=a.aoColumns[b].nTh;
                c.innerHTML=a.aoColumns[b].sTitle;
                a.aoColumns[b].sClass!==null&&i(c).addClass(a.aoColumns[b].sClass);
                f.appendChild(c)
            }
            i(a.nTHead).html("")[0].appendChild(f);
            Y(a.aoHeader,a.nTHead)
        }
        if(a.bJUI){
            b=0;
            for(d=a.aoColumns.length;b<d;b++){
                c=a.aoColumns[b].nTh;
                f=p.createElement("div");
                f.className=a.oClasses.sSortJUIWrapper;
                i(c).contents().appendTo(f);
                var e=p.createElement("span");
                e.className=a.oClasses.sSortIcon;
                f.appendChild(e);
                c.appendChild(f)
            }
        }
        d=function(){
            this.onselectstart=function(){
                return false
            };

            return false
        };

        if(a.oFeatures.bSort)for(b=0;b<a.aoColumns.length;b++)if(a.aoColumns[b].bSortable!==false){
            ja(a,a.aoColumns[b].nTh,b);
            i(a.aoColumns[b].nTh).bind("mousedown.DT",d)
        }else i(a.aoColumns[b].nTh).addClass(a.oClasses.sSortableNone);a.oClasses.sFooterTH!==""&&i(a.nTFoot).children("tr").children("th").addClass(a.oClasses.sFooterTH);
        if(a.nTFoot!==null){
            c=S(a,null,a.aoFooter);
            b=0;
            for(d=a.aoColumns.length;b<d;b++)if(typeof c[b]!="undefined")a.aoColumns[b].nTf=c[b]
        }
    }
    function M(a,b,c){
        var d,f,e,h=[],j=[],k=a.aoColumns.length;
        if(typeof c=="undefined")c=false;
        d=0;
        for(f=b.length;d<f;d++){
            h[d]=b[d].slice();
            h[d].nTr=b[d].nTr;
            for(e=k-1;e>=0;e--)!a.aoColumns[e].bVisible&&!c&&h[d].splice(e,1);
            j.push([])
        }
        d=0;
        for(f=h.length;d<f;d++){
            if(h[d].nTr){
                a=0;
                for(e=h[d].nTr.childNodes.length;a<e;a++)h[d].nTr.removeChild(h[d].nTr.childNodes[0])
            }
            e=0;
            for(b=h[d].length;e<b;e++){
                k=c=1;
                if(typeof j[d][e]=="undefined"){
                    h[d].nTr.appendChild(h[d][e].cell);
                    for(j[d][e]=1;typeof h[d+c]!="undefined"&&h[d][e].cell==h[d+c][e].cell;){
                        j[d+c][e]=1;
                        c++
                    }
                    for(;typeof h[d][e+k]!="undefined"&&h[d][e].cell==h[d][e+k].cell;){
                        for(a=0;a<c;a++)j[d+a][e+k]=1;
                        k++
                    }
                    h[d][e].cell.rowSpan=c;
                    h[d][e].cell.colSpan=k
                }
            }
        }
    }
    function C(a){
        var b,c,d=[],f=0,e=false;
        b=a.asStripeClasses.length;
        c=a.aoOpenRows.length;
        if(!(a.fnPreDrawCallback!==null&&a.fnPreDrawCallback.call(a.oInstance,a)===
            false)){
            a.bDrawing=true;
            if(typeof a.iInitDisplayStart!="undefined"&&a.iInitDisplayStart!=-1){
                a._iDisplayStart=a.oFeatures.bServerSide?a.iInitDisplayStart:a.iInitDisplayStart>=a.fnRecordsDisplay()?0:a.iInitDisplayStart;
                a.iInitDisplayStart=-1;
                E(a)
            }
            if(a.bDeferLoading){
                a.bDeferLoading=false;
                a.iDraw++
            }else if(a.oFeatures.bServerSide){
                if(!a.bDestroying&&!Ca(a))return
            }else a.iDraw++;
            if(a.aiDisplay.length!==0){
                var h=a._iDisplayStart,j=a._iDisplayEnd;
                if(a.oFeatures.bServerSide){
                    h=0;
                    j=a.aoData.length
                }
                for(h=
                    h;h<j;h++){
                    var k=a.aoData[a.aiDisplay[h]];
                    k.nTr===null&&z(a,a.aiDisplay[h]);
                    var m=k.nTr;
                    if(b!==0){
                        var u=a.asStripeClasses[f%b];
                        if(k._sRowStripe!=u){
                            i(m).removeClass(k._sRowStripe).addClass(u);
                            k._sRowStripe=u
                        }
                    }
                    if(typeof a.fnRowCallback=="function"){
                        m=a.fnRowCallback.call(a.oInstance,m,a.aoData[a.aiDisplay[h]]._aData,f,h);
                        if(!m&&!e){
                            J(a,0,"A node was not returned by fnRowCallback");
                            e=true
                        }
                    }
                    d.push(m);
                    f++;
                    if(c!==0)for(k=0;k<c;k++)m==a.aoOpenRows[k].nParent&&d.push(a.aoOpenRows[k].nTr)
                }
            }
            else{
                d[0]=p.createElement("tr");
                if(typeof a.asStripeClasses[0]!="undefined")d[0].className=a.asStripeClasses[0];
                e=a.oLanguage.sZeroRecords.replace("_MAX_",a.fnFormatNumber(a.fnRecordsTotal()));
                if(a.iDraw==1&&a.sAjaxSource!==null&&!a.oFeatures.bServerSide)e=a.oLanguage.sLoadingRecords;
                else if(typeof a.oLanguage.sEmptyTable!="undefined"&&a.fnRecordsTotal()===0)e=a.oLanguage.sEmptyTable;
                b=p.createElement("td");
                b.setAttribute("valign","top");
                b.colSpan=Z(a);
                b.className=a.oClasses.sRowEmpty;
                b.innerHTML=e;
                d[f].appendChild(b)
            }
            typeof a.fnHeaderCallback==
            "function"&&a.fnHeaderCallback.call(a.oInstance,i(a.nTHead).children("tr")[0],ca(a),a._iDisplayStart,a.fnDisplayEnd(),a.aiDisplay);
            typeof a.fnFooterCallback=="function"&&a.fnFooterCallback.call(a.oInstance,i(a.nTFoot).children("tr")[0],ca(a),a._iDisplayStart,a.fnDisplayEnd(),a.aiDisplay);
            f=p.createDocumentFragment();
            b=p.createDocumentFragment();
            if(a.nTBody){
                e=a.nTBody.parentNode;
                b.appendChild(a.nTBody);
                if(!a.oScroll.bInfinite||!a._bInitComplete||a.bSorted||a.bFiltered){
                    c=a.nTBody.childNodes;
                    for(b=
                        c.length-1;b>=0;b--)c[b].parentNode.removeChild(c[b])
                }
                b=0;
                for(c=d.length;b<c;b++)f.appendChild(d[b]);
                a.nTBody.appendChild(f);
                e!==null&&e.appendChild(a.nTBody)
            }
            for(b=a.aoDrawCallback.length-1;b>=0;b--)a.aoDrawCallback[b].fn.call(a.oInstance,a);
            i(a.oInstance).trigger("draw",a);
            a.bSorted=false;
            a.bFiltered=false;
            a.bDrawing=false;
            if(a.oFeatures.bServerSide){
                K(a,false);
                typeof a._bInitComplete=="undefined"&&w(a)
            }
        }
    }
    function da(a){
        if(a.oFeatures.bSort)R(a,a.oPreviousSearch);
        else if(a.oFeatures.bFilter)N(a,
            a.oPreviousSearch);
        else{
            E(a);
            C(a)
        }
    }
    function Ca(a){
        if(a.bAjaxDataGet){
            a.iDraw++;
            K(a,true);
            var b=Da(a);
            ha(a,b);
            a.fnServerData.call(a.oInstance,a.sAjaxSource,b,function(c){
                Ea(a,c)
            },a);
            return false
        }
        else return true
    }
    function Da(a){
        var b=a.aoColumns.length,c=[],d,f;
        c.push({
            name:"sEcho",
            value:a.iDraw
        });
        c.push({
            name:"iColumns",
            value:b
        });
        c.push({
            name:"sColumns",
            value:ka(a)
        });
        c.push({
            name:"iDisplayStart",
            value:a._iDisplayStart
        });
        c.push({
            name:"iDisplayLength",
            value:a.oFeatures.bPaginate!==false?a._iDisplayLength:
            -1
        });
        for(f=0;f<b;f++){
            d=a.aoColumns[f].mDataProp;
            c.push({
                name:"mDataProp_"+f,
                value:typeof d=="function"?"function":d
            })
        }
        if(a.oFeatures.bFilter!==false){
            c.push({
                name:"sSearch",
                value:a.oPreviousSearch.sSearch
            });
            c.push({
                name:"bRegex",
                value:a.oPreviousSearch.bRegex
            });
            for(f=0;f<b;f++){
                c.push({
                    name:"sSearch_"+f,
                    value:a.aoPreSearchCols[f].sSearch
                });
                c.push({
                    name:"bRegex_"+f,
                    value:a.aoPreSearchCols[f].bRegex
                });
                c.push({
                    name:"bSearchable_"+f,
                    value:a.aoColumns[f].bSearchable
                })
            }
        }
        if(a.oFeatures.bSort!==false){
            d=
            a.aaSortingFixed!==null?a.aaSortingFixed.length:0;
            var e=a.aaSorting.length;
            c.push({
                name:"iSortingCols",
                value:d+e
            });
            for(f=0;f<d;f++){
                c.push({
                    name:"iSortCol_"+f,
                    value:a.aaSortingFixed[f][0]
                });
                c.push({
                    name:"sSortDir_"+f,
                    value:a.aaSortingFixed[f][1]
                })
            }
            for(f=0;f<e;f++){
                c.push({
                    name:"iSortCol_"+(f+d),
                    value:a.aaSorting[f][0]
                });
                c.push({
                    name:"sSortDir_"+(f+d),
                    value:a.aaSorting[f][1]
                })
            }
            for(f=0;f<b;f++)c.push({
                name:"bSortable_"+f,
                value:a.aoColumns[f].bSortable
            })
        }
        return c
    }
    function ha(a,b){
        for(var c=0,d=a.aoServerParams.length;c<
            d;c++)a.aoServerParams[c].fn.call(a.oInstance,b)
    }
    function Ea(a,b){
        if(typeof b.sEcho!="undefined")if(b.sEcho*1<a.iDraw)return;else a.iDraw=b.sEcho*1;
        if(!a.oScroll.bInfinite||a.oScroll.bInfinite&&(a.bSorted||a.bFiltered))la(a);
        a._iRecordsTotal=b.iTotalRecords;
        a._iRecordsDisplay=b.iTotalDisplayRecords;
        var c=ka(a);
        if(c=typeof b.sColumns!="undefined"&&c!==""&&b.sColumns!=c)var d=Fa(a,b.sColumns);
        b=aa(a.sAjaxDataProp)(b);
        for(var f=0,e=b.length;f<e;f++)if(c){
            for(var h=[],j=0,k=a.aoColumns.length;j<k;j++)h.push(b[f][d[j]]);
            v(a,h)
        }else v(a,b[f]);a.aiDisplay=a.aiDisplayMaster.slice();
        a.bAjaxDataGet=false;
        C(a);
        a.bAjaxDataGet=true;
        K(a,false)
    }
    function Aa(a){
        var b=p.createElement("div");
        a.nTable.parentNode.insertBefore(b,a.nTable);
        a.nTableWrapper=p.createElement("div");
        a.nTableWrapper.className=a.oClasses.sWrapper;
        a.sTableId!==""&&a.nTableWrapper.setAttribute("id",a.sTableId+"_wrapper");
        a.nTableReinsertBefore=a.nTable.nextSibling;
        for(var c=a.nTableWrapper,d=a.sDom.split(""),f,e,h,j,k,m,u,r=0;r<d.length;r++){
            e=0;
            h=d[r];
            if(h==
                "<"){
                j=p.createElement("div");
                k=d[r+1];
                if(k=="'"||k=='"'){
                    m="";
                    for(u=2;d[r+u]!=k;){
                        m+=d[r+u];
                        u++
                    }
                    if(m=="H")m="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix";
                    else if(m=="F")m="fg-toolbar ui-toolbar ui-widget-header ui-corner-bl ui-corner-br ui-helper-clearfix";
                    if(m.indexOf(".")!=-1){
                        k=m.split(".");
                        j.setAttribute("id",k[0].substr(1,k[0].length-1));
                        j.className=k[1]
                    }
                    else if(m.charAt(0)=="#")j.setAttribute("id",m.substr(1,m.length-1));else j.className=m;
                    r+=u
                }
                c.appendChild(j);
                c=j
            }else if(h==">")c=c.parentNode;
            else if(h=="l"&&a.oFeatures.bPaginate&&a.oFeatures.bLengthChange){
                f=Ga(a);
                e=1
            }
            else if(h=="f"&&a.oFeatures.bFilter){
                f=Ha(a);
                e=1
            }
            else if(h=="r"&&a.oFeatures.bProcessing){
                f=Ia(a);
                e=1
            }else if(h=="t"){
                f=Ja(a);
                e=1
            }else if(h=="i"&&a.oFeatures.bInfo){
                f=Ka(a);
                e=1
            }else if(h=="p"&&a.oFeatures.bPaginate){
                f=La(a);
                e=1
            }else if(n.aoFeatures.length!==0){
                j=n.aoFeatures;
                u=0;
                for(k=j.length;u<k;u++)if(h==j[u].cFeature){
                    if(f=j[u].fnInit(a))e=1;
                    break
                }
            }
            if(e==1&&f!==null){
                if(typeof a.aanFeatures[h]!=
                    "object")a.aanFeatures[h]=[];
                a.aanFeatures[h].push(f);
                c.appendChild(f)
            }
        }
        b.parentNode.replaceChild(a.nTableWrapper,b)
    }
    function Ja(a){
        if(a.oScroll.sX===""&&a.oScroll.sY==="")return a.nTable;
        var b=p.createElement("div"),c=p.createElement("div"),d=p.createElement("div"),f=p.createElement("div"),e=p.createElement("div"),h=p.createElement("div"),j=a.nTable.cloneNode(false),k=a.nTable.cloneNode(false),m=a.nTable.getElementsByTagName("thead")[0],u=a.nTable.getElementsByTagName("tfoot").length===0?null:a.nTable.getElementsByTagName("tfoot")[0],
        r=typeof g.bJQueryUI!="undefined"&&g.bJQueryUI?n.oJUIClasses:n.oStdClasses;
        c.appendChild(d);
        e.appendChild(h);
        f.appendChild(a.nTable);
        b.appendChild(c);
        b.appendChild(f);
        d.appendChild(j);
        j.appendChild(m);
        if(u!==null){
            b.appendChild(e);
            h.appendChild(k);
            k.appendChild(u)
        }
        b.className=r.sScrollWrapper;
        c.className=r.sScrollHead;
        d.className=r.sScrollHeadInner;
        f.className=r.sScrollBody;
        e.className=r.sScrollFoot;
        h.className=r.sScrollFootInner;
        if(a.oScroll.bAutoCss){
            c.style.overflow="hidden";
            c.style.position="relative";
            e.style.overflow="hidden";
            f.style.overflow="auto"
        }
        c.style.border="0";
        c.style.width="100%";
        e.style.border="0";
        d.style.width="150%";
        j.removeAttribute("id");
        j.style.marginLeft="0";
        a.nTable.style.marginLeft="0";
        if(u!==null){
            k.removeAttribute("id");
            k.style.marginLeft="0"
        }
        d=i(a.nTable).children("caption");
        h=0;
        for(k=d.length;h<k;h++)j.appendChild(d[h]);
        if(a.oScroll.sX!==""){
            c.style.width=q(a.oScroll.sX);
            f.style.width=q(a.oScroll.sX);
            if(u!==null)e.style.width=q(a.oScroll.sX);
            i(f).scroll(function(){
                c.scrollLeft=
                this.scrollLeft;
                if(u!==null)e.scrollLeft=this.scrollLeft
            })
        }
        if(a.oScroll.sY!=="")f.style.height=q(a.oScroll.sY);
        a.aoDrawCallback.push({
            fn:Ma,
            sName:"scrolling"
        });
        a.oScroll.bInfinite&&i(f).scroll(function(){
            if(!a.bDrawing)if(i(this).scrollTop()+i(this).height()>i(a.nTable).height()-a.oScroll.iLoadGap)if(a.fnDisplayEnd()<a.fnRecordsDisplay()){
                ma(a,"next");
                E(a);
                C(a)
            }
        });
        a.nScrollHead=c;
        a.nScrollFoot=e;
        return b
    }
    function Ma(a){
        var b=a.nScrollHead.getElementsByTagName("div")[0],c=b.getElementsByTagName("table")[0],
        d=a.nTable.parentNode,f,e,h,j,k,m,u,r,H=[],L=a.nTFoot!==null?a.nScrollFoot.getElementsByTagName("div")[0]:null,T=a.nTFoot!==null?L.getElementsByTagName("table")[0]:null,B=i.browser.msie&&i.browser.version<=7;
        h=a.nTable.getElementsByTagName("thead");
        h.length>0&&a.nTable.removeChild(h[0]);
        if(a.nTFoot!==null){
            k=a.nTable.getElementsByTagName("tfoot");
            k.length>0&&a.nTable.removeChild(k[0])
        }
        h=a.nTHead.cloneNode(true);
        a.nTable.insertBefore(h,a.nTable.childNodes[0]);
        if(a.nTFoot!==null){
            k=a.nTFoot.cloneNode(true);
            a.nTable.insertBefore(k,a.nTable.childNodes[1])
        }
        if(a.oScroll.sX===""){
            d.style.width="100%";
            b.parentNode.style.width="100%"
        }
        var U=S(a,h);
        f=0;
        for(e=U.length;f<e;f++){
            u=Na(a,f);
            U[f].style.width=a.aoColumns[u].sWidth
        }
        a.nTFoot!==null&&P(function(I){
            I.style.width=""
        },k.getElementsByTagName("tr"));
        f=i(a.nTable).outerWidth();
        if(a.oScroll.sX===""){
            a.nTable.style.width="100%";
            if(B&&(d.scrollHeight>d.offsetHeight||i(d).css("overflow-y")=="scroll"))a.nTable.style.width=q(i(a.nTable).outerWidth()-a.oScroll.iBarWidth)
        }else if(a.oScroll.sXInner!==
            "")a.nTable.style.width=q(a.oScroll.sXInner);
        else if(f==i(d).width()&&i(d).height()<i(a.nTable).height()){
            a.nTable.style.width=q(f-a.oScroll.iBarWidth);
            if(i(a.nTable).outerWidth()>f-a.oScroll.iBarWidth)a.nTable.style.width=q(f)
        }else a.nTable.style.width=q(f);
        f=i(a.nTable).outerWidth();
        e=a.nTHead.getElementsByTagName("tr");
        h=h.getElementsByTagName("tr");
        P(function(I,na){
            m=I.style;
            m.paddingTop="0";
            m.paddingBottom="0";
            m.borderTopWidth="0";
            m.borderBottomWidth="0";
            m.height=0;
            r=i(I).width();
            na.style.width=
            q(r);
            H.push(r)
        },h,e);
        i(h).height(0);
        if(a.nTFoot!==null){
            j=k.getElementsByTagName("tr");
            k=a.nTFoot.getElementsByTagName("tr");
            P(function(I,na){
                m=I.style;
                m.paddingTop="0";
                m.paddingBottom="0";
                m.borderTopWidth="0";
                m.borderBottomWidth="0";
                m.height=0;
                r=i(I).width();
                na.style.width=q(r);
                H.push(r)
            },j,k);
            i(j).height(0)
        }
        P(function(I){
            I.innerHTML="";
            I.style.width=q(H.shift())
        },h);
        a.nTFoot!==null&&P(function(I){
            I.innerHTML="";
            I.style.width=q(H.shift())
        },j);
        if(i(a.nTable).outerWidth()<f){
            j=d.scrollHeight>d.offsetHeight||
            i(d).css("overflow-y")=="scroll"?f+a.oScroll.iBarWidth:f;
            if(B&&(d.scrollHeight>d.offsetHeight||i(d).css("overflow-y")=="scroll"))a.nTable.style.width=q(j-a.oScroll.iBarWidth);
            d.style.width=q(j);
            b.parentNode.style.width=q(j);
            if(a.nTFoot!==null)L.parentNode.style.width=q(j);
            if(a.oScroll.sX==="")J(a,1,"The table cannot fit into the current element which will cause column misalignment. The table has been drawn at its minimum possible width.");else a.oScroll.sXInner!==""&&J(a,1,"The table cannot fit into the current element which will cause column misalignment. Increase the sScrollXInner value or remove it to allow automatic calculation")
        }else{
            d.style.width=
            q("100%");
            b.parentNode.style.width=q("100%");
            if(a.nTFoot!==null)L.parentNode.style.width=q("100%")
        }
        if(a.oScroll.sY==="")if(B)d.style.height=q(a.nTable.offsetHeight+a.oScroll.iBarWidth);
        if(a.oScroll.sY!==""&&a.oScroll.bCollapse){
            d.style.height=q(a.oScroll.sY);
            B=a.oScroll.sX!==""&&a.nTable.offsetWidth>d.offsetWidth?a.oScroll.iBarWidth:0;
            if(a.nTable.offsetHeight<d.offsetHeight)d.style.height=q(i(a.nTable).height()+B)
        }
        B=i(a.nTable).outerWidth();
        c.style.width=q(B);
        b.style.width=q(B+a.oScroll.iBarWidth);
        if(a.nTFoot!==null){
            L.style.width=q(a.nTable.offsetWidth+a.oScroll.iBarWidth);
            T.style.width=q(a.nTable.offsetWidth)
        }
        if(a.bSorted||a.bFiltered)d.scrollTop=0
    }
    function ea(a){
        if(a.oFeatures.bAutoWidth===false)return false;
        ga(a);
        for(var b=0,c=a.aoColumns.length;b<c;b++)a.aoColumns[b].nTh.style.width=a.aoColumns[b].sWidth
    }
    function Ha(a){
        var b=a.oLanguage.sSearch;
        b=b.indexOf("_INPUT_")!==-1?b.replace("_INPUT_",'<input type="text" />'):b===""?'<input type="text" />':b+' <input type="text" />';
        var c=p.createElement("div");
        c.className=a.oClasses.sFilter;
        c.innerHTML="<label>"+b+"</label>";
        a.sTableId!==""&&typeof a.aanFeatures.f=="undefined"&&c.setAttribute("id",a.sTableId+"_filter");
        b=i("input",c);
        b.val(a.oPreviousSearch.sSearch.replace('"',"&quot;"));
        b.bind("keyup.DT",function(){
            for(var d=a.aanFeatures.f,f=0,e=d.length;f<e;f++)d[f]!=i(this).parents("div.dataTables_filter")[0]&&i("input",d[f]).val(this.value);
            this.value!=a.oPreviousSearch.sSearch&&N(a,{
                sSearch:this.value,
                bRegex:a.oPreviousSearch.bRegex,
                bSmart:a.oPreviousSearch.bSmart
            })
        });
        b.bind("keypress.DT",function(d){
            if(d.keyCode==13)return false
        });
        return c
    }
    function N(a,b,c){
        Oa(a,b.sSearch,c,b.bRegex,b.bSmart);
        for(b=0;b<a.aoPreSearchCols.length;b++)Pa(a,a.aoPreSearchCols[b].sSearch,b,a.aoPreSearchCols[b].bRegex,a.aoPreSearchCols[b].bSmart);
        n.afnFiltering.length!==0&&Qa(a);
        a.bFiltered=true;
        i(a.oInstance).trigger("filter",a);
        a._iDisplayStart=0;
        E(a);
        C(a);
        oa(a,0)
    }
    function Qa(a){
        for(var b=n.afnFiltering,c=0,d=b.length;c<d;c++)for(var f=0,e=0,h=a.aiDisplay.length;e<h;e++){
            var j=a.aiDisplay[e-
            f];
            if(!b[c](a,fa(a,j,"filter"),j)){
                a.aiDisplay.splice(e-f,1);
                f++
            }
        }
    }
    function Pa(a,b,c,d,f){
        if(b!==""){
            var e=0;
            b=pa(b,d,f);
            for(d=a.aiDisplay.length-1;d>=0;d--){
                f=qa(G(a,a.aiDisplay[d],c,"filter"),a.aoColumns[c].sType);
                if(!b.test(f)){
                    a.aiDisplay.splice(d,1);
                    e++
                }
            }
        }
    }
    function Oa(a,b,c,d,f){
        var e=pa(b,d,f);
        if(typeof c=="undefined"||c===null)c=0;
        if(n.afnFiltering.length!==0)c=1;
        if(b.length<=0){
            a.aiDisplay.splice(0,a.aiDisplay.length);
            a.aiDisplay=a.aiDisplayMaster.slice()
        }else if(a.aiDisplay.length==a.aiDisplayMaster.length||
            a.oPreviousSearch.sSearch.length>b.length||c==1||b.indexOf(a.oPreviousSearch.sSearch)!==0){
            a.aiDisplay.splice(0,a.aiDisplay.length);
            oa(a,1);
            for(c=0;c<a.aiDisplayMaster.length;c++)e.test(a.asDataSearch[c])&&a.aiDisplay.push(a.aiDisplayMaster[c])
        }else{
            var h=0;
            for(c=0;c<a.asDataSearch.length;c++)if(!e.test(a.asDataSearch[c])){
                a.aiDisplay.splice(c-h,1);
                h++
            }
        }
        a.oPreviousSearch.sSearch=b;
        a.oPreviousSearch.bRegex=d;
        a.oPreviousSearch.bSmart=f
    }
    function oa(a,b){
        if(!a.oFeatures.bServerSide){
            a.asDataSearch.splice(0,
                a.asDataSearch.length);
            b=typeof b!="undefined"&&b==1?a.aiDisplayMaster:a.aiDisplay;
            for(var c=0,d=b.length;c<d;c++)a.asDataSearch[c]=ra(a,fa(a,b[c],"filter"))
        }
    }
    function ra(a,b){
        var c="";
        if(typeof a.__nTmpFilter=="undefined")a.__nTmpFilter=p.createElement("div");
        for(var d=a.__nTmpFilter,f=0,e=a.aoColumns.length;f<e;f++)if(a.aoColumns[f].bSearchable)c+=qa(b[f],a.aoColumns[f].sType)+"  ";if(c.indexOf("&")!==-1){
            d.innerHTML=c;
            c=d.textContent?d.textContent:d.innerText;
            c=c.replace(/\n/g," ").replace(/\r/g,
                "")
        }
        return c
    }
    function pa(a,b,c){
        if(c){
            a=b?a.split(" "):sa(a).split(" ");
            a="^(?=.*?"+a.join(")(?=.*?")+").*$";
            return new RegExp(a,"i")
        }else{
            a=b?a:sa(a);
            return new RegExp(a,"i")
        }
    }
    function qa(a,b){
        if(typeof n.ofnSearch[b]=="function")return n.ofnSearch[b](a);
        else if(b=="html")return a.replace(/\n/g," ").replace(/<.*?>/g,"");
        else if(typeof a=="string")return a.replace(/\n/g," ");
        else if(a===null)return"";
        return a
    }
    function R(a,b){
        var c,d,f,e,h=[],j=[],k=n.oSort;
        d=a.aoData;
        var m=a.aoColumns;
        if(!a.oFeatures.bServerSide&&
            (a.aaSorting.length!==0||a.aaSortingFixed!==null)){
            h=a.aaSortingFixed!==null?a.aaSortingFixed.concat(a.aaSorting):a.aaSorting.slice();
            for(c=0;c<h.length;c++){
                var u=h[c][0];
                f=ta(a,u);
                e=a.aoColumns[u].sSortDataType;
                if(typeof n.afnSortData[e]!="undefined"){
                    var r=n.afnSortData[e](a,u,f);
                    f=0;
                    for(e=d.length;f<e;f++)O(a,f,u,r[f])
                }
            }
            c=0;
            for(d=a.aiDisplayMaster.length;c<d;c++)j[a.aiDisplayMaster[c]]=c;
            var H=h.length;
            a.aiDisplayMaster.sort(function(L,T){
                var B,U;
                for(c=0;c<H;c++){
                    B=m[h[c][0]].iDataSort;
                    U=m[B].sType;
                    B=k[(U?U:"string")+"-"+h[c][1]](G(a,L,B,"sort"),G(a,T,B,"sort"));
                    if(B!==0)return B
                }
                return k["numeric-asc"](j[L],j[T])
            })
        }
        if((typeof b=="undefined"||b)&&!a.oFeatures.bDeferRender)V(a);
        a.bSorted=true;
        i(a.oInstance).trigger("sort",a);
        if(a.oFeatures.bFilter)N(a,a.oPreviousSearch,1);
        else{
            a.aiDisplay=a.aiDisplayMaster.slice();
            a._iDisplayStart=0;
            E(a);
            C(a)
        }
    }
    function ja(a,b,c,d){
        i(b).bind("click.DT",function(f){
            if(a.aoColumns[c].bSortable!==false){
                var e=function(){
                    var h,j;
                    if(f.shiftKey){
                        for(var k=false,m=0;m<
                            a.aaSorting.length;m++)if(a.aaSorting[m][0]==c){
                            k=true;
                            h=a.aaSorting[m][0];
                            j=a.aaSorting[m][2]+1;
                            if(typeof a.aoColumns[h].asSorting[j]=="undefined")a.aaSorting.splice(m,1);
                            else{
                                a.aaSorting[m][1]=a.aoColumns[h].asSorting[j];
                                a.aaSorting[m][2]=j
                            }
                            break
                        }
                        k===false&&a.aaSorting.push([c,a.aoColumns[c].asSorting[0],0])
                    }else if(a.aaSorting.length==1&&a.aaSorting[0][0]==c){
                        h=a.aaSorting[0][0];
                        j=a.aaSorting[0][2]+1;
                        if(typeof a.aoColumns[h].asSorting[j]=="undefined")j=0;
                        a.aaSorting[0][1]=a.aoColumns[h].asSorting[j];
                        a.aaSorting[0][2]=j
                    }else{
                        a.aaSorting.splice(0,a.aaSorting.length);
                        a.aaSorting.push([c,a.aoColumns[c].asSorting[0],0])
                    }
                    R(a)
                };

                if(a.oFeatures.bProcessing){
                    K(a,true);
                    setTimeout(function(){
                        e();
                        a.oFeatures.bServerSide||K(a,false)
                    },0)
                }else e();
                typeof d=="function"&&d(a)
            }
        })
    }
    function V(a){
        var b,c,d,f,e,h=a.aoColumns.length,j=a.oClasses;
        for(b=0;b<h;b++)a.aoColumns[b].bSortable&&i(a.aoColumns[b].nTh).removeClass(j.sSortAsc+" "+j.sSortDesc+" "+a.aoColumns[b].sSortingClass);
        f=a.aaSortingFixed!==null?a.aaSortingFixed.concat(a.aaSorting):
        a.aaSorting.slice();
        for(b=0;b<a.aoColumns.length;b++)if(a.aoColumns[b].bSortable){
            e=a.aoColumns[b].sSortingClass;
            d=-1;
            for(c=0;c<f.length;c++)if(f[c][0]==b){
                e=f[c][1]=="asc"?j.sSortAsc:j.sSortDesc;
                d=c;
                break
            }
            i(a.aoColumns[b].nTh).addClass(e);
            if(a.bJUI){
                c=i("span",a.aoColumns[b].nTh);
                c.removeClass(j.sSortJUIAsc+" "+j.sSortJUIDesc+" "+j.sSortJUI+" "+j.sSortJUIAscAllowed+" "+j.sSortJUIDescAllowed);
                c.addClass(d==-1?a.aoColumns[b].sSortingClassJUI:f[d][1]=="asc"?j.sSortJUIAsc:j.sSortJUIDesc)
            }
        }else i(a.aoColumns[b].nTh).addClass(a.aoColumns[b].sSortingClass);
        e=j.sSortColumn;
        if(a.oFeatures.bSort&&a.oFeatures.bSortClasses){
            d=Q(a);
            if(a.oFeatures.bDeferRender)i(d).removeClass(e+"1 "+e+"2 "+e+"3");
            else if(d.length>=h)for(b=0;b<h;b++)if(d[b].className.indexOf(e+"1")!=-1){
                c=0;
                for(a=d.length/h;c<a;c++)d[h*c+b].className=i.trim(d[h*c+b].className.replace(e+"1",""))
            }else if(d[b].className.indexOf(e+"2")!=-1){
                c=0;
                for(a=d.length/h;c<a;c++)d[h*c+b].className=i.trim(d[h*c+b].className.replace(e+"2",""))
            }else if(d[b].className.indexOf(e+"3")!=-1){
                c=0;
                for(a=d.length/
                    h;c<a;c++)d[h*c+b].className=i.trim(d[h*c+b].className.replace(" "+e+"3",""))
            }
            j=1;
            var k;
            for(b=0;b<f.length;b++){
                k=parseInt(f[b][0],10);
                c=0;
                for(a=d.length/h;c<a;c++)d[h*c+k].className+=" "+e+j;
                j<3&&j++
            }
        }
    }
    function La(a){
        if(a.oScroll.bInfinite)return null;
        var b=p.createElement("div");
        b.className=a.oClasses.sPaging+a.sPaginationType;
        n.oPagination[a.sPaginationType].fnInit(a,b,function(c){
            E(c);
            C(c)
        });
        typeof a.aanFeatures.p=="undefined"&&a.aoDrawCallback.push({
            fn:function(c){
                n.oPagination[c.sPaginationType].fnUpdate(c,
                    function(d){
                        E(d);
                        C(d)
                    })
            },
            sName:"pagination"
        });
        return b
    }
    function ma(a,b){
        var c=a._iDisplayStart;
        if(b=="first")a._iDisplayStart=0;
        else if(b=="previous"){
            a._iDisplayStart=a._iDisplayLength>=0?a._iDisplayStart-a._iDisplayLength:0;
            if(a._iDisplayStart<0)a._iDisplayStart=0
        }else if(b=="next")if(a._iDisplayLength>=0){
            if(a._iDisplayStart+a._iDisplayLength<a.fnRecordsDisplay())a._iDisplayStart+=a._iDisplayLength
        }else a._iDisplayStart=0;
        else if(b=="last")if(a._iDisplayLength>=0){
            b=parseInt((a.fnRecordsDisplay()-
                1)/a._iDisplayLength,10)+1;
            a._iDisplayStart=(b-1)*a._iDisplayLength
        }else a._iDisplayStart=0;else J(a,0,"Unknown paging action: "+b);
        i(a.oInstance).trigger("page",a);
        return c!=a._iDisplayStart
    }
    function Ka(a){
        var b=p.createElement("div");
        b.className=a.oClasses.sInfo;
        if(typeof a.aanFeatures.i=="undefined"){
            a.aoDrawCallback.push({
                fn:Ra,
                sName:"information"
            });
            a.sTableId!==""&&b.setAttribute("id",a.sTableId+"_info")
        }
        return b
    }
    function Ra(a){
        if(!(!a.oFeatures.bInfo||a.aanFeatures.i.length===0)){
            var b=a._iDisplayStart+
            1,c=a.fnDisplayEnd(),d=a.fnRecordsTotal(),f=a.fnRecordsDisplay(),e=a.fnFormatNumber(b),h=a.fnFormatNumber(c),j=a.fnFormatNumber(d),k=a.fnFormatNumber(f);
            if(a.oScroll.bInfinite)e=a.fnFormatNumber(1);
            e=a.fnRecordsDisplay()===0&&a.fnRecordsDisplay()==a.fnRecordsTotal()?a.oLanguage.sInfoEmpty+a.oLanguage.sInfoPostFix:a.fnRecordsDisplay()===0?a.oLanguage.sInfoEmpty+" "+a.oLanguage.sInfoFiltered.replace("_MAX_",j)+a.oLanguage.sInfoPostFix:a.fnRecordsDisplay()==a.fnRecordsTotal()?a.oLanguage.sInfo.replace("_START_",
                e).replace("_END_",h).replace("_TOTAL_",k)+a.oLanguage.sInfoPostFix:a.oLanguage.sInfo.replace("_START_",e).replace("_END_",h).replace("_TOTAL_",k)+" "+a.oLanguage.sInfoFiltered.replace("_MAX_",a.fnFormatNumber(a.fnRecordsTotal()))+a.oLanguage.sInfoPostFix;
            if(a.oLanguage.fnInfoCallback!==null)e=a.oLanguage.fnInfoCallback(a,b,c,d,f,e);
            a=a.aanFeatures.i;
            b=0;
            for(c=a.length;b<c;b++)i(a[b]).html(e)
        }
    }
    function Ga(a){
        if(a.oScroll.bInfinite)return null;
        var b='<select size="1" '+(a.sTableId===""?"":'name="'+
            a.sTableId+'_length"')+">",c,d;
        if(a.aLengthMenu.length==2&&typeof a.aLengthMenu[0]=="object"&&typeof a.aLengthMenu[1]=="object"){
            c=0;
            for(d=a.aLengthMenu[0].length;c<d;c++)b+='<option value="'+a.aLengthMenu[0][c]+'">'+a.aLengthMenu[1][c]+"</option>"
        }else{
            c=0;
            for(d=a.aLengthMenu.length;c<d;c++)b+='<option value="'+a.aLengthMenu[c]+'">'+a.aLengthMenu[c]+"</option>"
        }
        b+="</select>";
        var f=p.createElement("div");
        a.sTableId!==""&&typeof a.aanFeatures.l=="undefined"&&f.setAttribute("id",a.sTableId+"_length");
        f.className=a.oClasses.sLength;
        f.innerHTML="<label>"+a.oLanguage.sLengthMenu.replace("_MENU_",b)+"</label>";
        i('select option[value="'+a._iDisplayLength+'"]',f).attr("selected",true);
        i("select",f).bind("change.DT",function(){
            var e=i(this).val(),h=a.aanFeatures.l;
            c=0;
            for(d=h.length;c<d;c++)h[c]!=this.parentNode&&i("select",h[c]).val(e);
            a._iDisplayLength=parseInt(e,10);
            E(a);
            if(a.fnDisplayEnd()==a.fnRecordsDisplay()){
                a._iDisplayStart=a.fnDisplayEnd()-a._iDisplayLength;
                if(a._iDisplayStart<0)a._iDisplayStart=
                    0
            }
            if(a._iDisplayLength==-1)a._iDisplayStart=0;
            C(a)
        });
        return f
    }
    function Ia(a){
        var b=p.createElement("div");
        a.sTableId!==""&&typeof a.aanFeatures.r=="undefined"&&b.setAttribute("id",a.sTableId+"_processing");
        b.innerHTML=a.oLanguage.sProcessing;
        b.className=a.oClasses.sProcessing;
        a.nTable.parentNode.insertBefore(b,a.nTable);
        return b
    }
    function K(a,b){
        if(a.oFeatures.bProcessing){
            a=a.aanFeatures.r;
            for(var c=0,d=a.length;c<d;c++)a[c].style.visibility=b?"visible":"hidden"
        }
    }
    function Na(a,b){
        for(var c=-1,d=0;d<
            a.aoColumns.length;d++){
            a.aoColumns[d].bVisible===true&&c++;
            if(c==b)return d
        }
        return null
    }
    function ta(a,b){
        for(var c=-1,d=0;d<a.aoColumns.length;d++){
            a.aoColumns[d].bVisible===true&&c++;
            if(d==b)return a.aoColumns[d].bVisible===true?c:null
        }
        return null
    }
    function W(a,b){
        var c,d;
        c=a._iDisplayStart;
        for(d=a._iDisplayEnd;c<d;c++)if(a.aoData[a.aiDisplay[c]].nTr==b)return a.aiDisplay[c];c=0;
        for(d=a.aoData.length;c<d;c++)if(a.aoData[c].nTr==b)return c;return null
    }
    function Z(a){
        for(var b=0,c=0;c<a.aoColumns.length;c++)a.aoColumns[c].bVisible===
            true&&b++;
        return b
    }
    function E(a){
        a._iDisplayEnd=a.oFeatures.bPaginate===false?a.aiDisplay.length:a._iDisplayStart+a._iDisplayLength>a.aiDisplay.length||a._iDisplayLength==-1?a.aiDisplay.length:a._iDisplayStart+a._iDisplayLength
    }
    function Sa(a,b){
        if(!a||a===null||a==="")return 0;
        if(typeof b=="undefined")b=p.getElementsByTagName("body")[0];
        var c=p.createElement("div");
        c.style.width=q(a);
        b.appendChild(c);
        a=c.offsetWidth;
        b.removeChild(c);
        return a
    }
    function ga(a){
        var b=0,c,d=0,f=a.aoColumns.length,e,h=i("th",
            a.nTHead);
        for(e=0;e<f;e++)if(a.aoColumns[e].bVisible){
            d++;
            if(a.aoColumns[e].sWidth!==null){
                c=Sa(a.aoColumns[e].sWidthOrig,a.nTable.parentNode);
                if(c!==null)a.aoColumns[e].sWidth=q(c);
                b++
            }
        }
        if(f==h.length&&b===0&&d==f&&a.oScroll.sX===""&&a.oScroll.sY==="")for(e=0;e<a.aoColumns.length;e++){
            c=i(h[e]).width();
            if(c!==null)a.aoColumns[e].sWidth=q(c)
        }else{
            b=a.nTable.cloneNode(false);
            e=a.nTHead.cloneNode(true);
            d=p.createElement("tbody");
            c=p.createElement("tr");
            b.removeAttribute("id");
            b.appendChild(e);
            if(a.nTFoot!==
                null){
                b.appendChild(a.nTFoot.cloneNode(true));
                P(function(k){
                    k.style.width=""
                },b.getElementsByTagName("tr"))
            }
            b.appendChild(d);
            d.appendChild(c);
            d=i("thead th",b);
            if(d.length===0)d=i("tbody tr:eq(0)>td",b);
            h=S(a,e);
            for(e=d=0;e<f;e++){
                var j=a.aoColumns[e];
                if(j.bVisible&&j.sWidthOrig!==null&&j.sWidthOrig!=="")h[e-d].style.width=q(j.sWidthOrig);
                else if(j.bVisible)h[e-d].style.width="";else d++
            }
            for(e=0;e<f;e++)if(a.aoColumns[e].bVisible){
                d=Ta(a,e);
                if(d!==null){
                    d=d.cloneNode(true);
                    if(a.aoColumns[e].sContentPadding!==
                        "")d.innerHTML+=a.aoColumns[e].sContentPadding;
                    c.appendChild(d)
                }
            }
            f=a.nTable.parentNode;
            f.appendChild(b);
            if(a.oScroll.sX!==""&&a.oScroll.sXInner!=="")b.style.width=q(a.oScroll.sXInner);
            else if(a.oScroll.sX!==""){
                b.style.width="";
                if(i(b).width()<f.offsetWidth)b.style.width=q(f.offsetWidth)
            }else if(a.oScroll.sY!=="")b.style.width=q(f.offsetWidth);
            b.style.visibility="hidden";
            Ua(a,b);
            f=i("tbody tr:eq(0)",b).children();
            if(f.length===0)f=S(a,i("thead",b)[0]);
            if(a.oScroll.sX!==""){
                for(e=d=c=0;e<a.aoColumns.length;e++)if(a.aoColumns[e].bVisible){
                    c+=
                    a.aoColumns[e].sWidthOrig===null?i(f[d]).outerWidth():parseInt(a.aoColumns[e].sWidth.replace("px",""),10)+(i(f[d]).outerWidth()-i(f[d]).width());
                    d++
                }
                b.style.width=q(c);
                a.nTable.style.width=q(c)
            }
            for(e=d=0;e<a.aoColumns.length;e++)if(a.aoColumns[e].bVisible){
                c=i(f[d]).width();
                if(c!==null&&c>0)a.aoColumns[e].sWidth=q(c);
                d++
            }
            a.nTable.style.width=q(i(b).outerWidth());
            b.parentNode.removeChild(b)
        }
    }
    function Ua(a,b){
        if(a.oScroll.sX===""&&a.oScroll.sY!==""){
            i(b).width();
            b.style.width=q(i(b).outerWidth()-a.oScroll.iBarWidth)
        }else if(a.oScroll.sX!==
            "")b.style.width=q(i(b).outerWidth())
    }
    function Ta(a,b){
        var c=Va(a,b);
        if(c<0)return null;
        if(a.aoData[c].nTr===null){
            var d=p.createElement("td");
            d.innerHTML=G(a,c,b,"");
            return d
        }
        return Q(a,c)[b]
    }
    function Va(a,b){
        for(var c=-1,d=-1,f=0;f<a.aoData.length;f++){
            var e=G(a,f,b,"display")+"";
            e=e.replace(/<.*?>/g,"");
            if(e.length>c){
                c=e.length;
                d=f
            }
        }
        return d
    }
    function q(a){
        if(a===null)return"0px";
        if(typeof a=="number"){
            if(a<0)return"0px";
            return a+"px"
        }
        var b=a.charCodeAt(a.length-1);
        if(b<48||b>57)return a;
        return a+
        "px"
    }
    function Za(a,b){
        if(a.length!=b.length)return 1;
        for(var c=0;c<a.length;c++)if(a[c]!=b[c])return 2;return 0
    }
    function ia(a){
        for(var b=n.aTypes,c=b.length,d=0;d<c;d++){
            var f=b[d](a);
            if(f!==null)return f
        }
        return"string"
    }
    function A(a){
        for(var b=0;b<D.length;b++)if(D[b].nTable==a)return D[b];return null
    }
    function ca(a){
        for(var b=[],c=a.aoData.length,d=0;d<c;d++)b.push(a.aoData[d]._aData);
        return b
    }
    function ba(a){
        for(var b=[],c=0,d=a.aoData.length;c<d;c++)a.aoData[c].nTr!==null&&b.push(a.aoData[c].nTr);
        return b
    }
    function Q(a,b){
        var c=[],d,f,e,h,j;
        f=0;
        var k=a.aoData.length;
        if(typeof b!="undefined"){
            f=b;
            k=b+1
        }
        for(f=f;f<k;f++){
            j=a.aoData[f];
            if(j.nTr!==null){
                b=[];
                e=0;
                for(h=j.nTr.childNodes.length;e<h;e++){
                    d=j.nTr.childNodes[e].nodeName.toLowerCase();
                    if(d=="td"||d=="th")b.push(j.nTr.childNodes[e])
                }
                e=d=0;
                for(h=a.aoColumns.length;e<h;e++)if(a.aoColumns[e].bVisible)c.push(b[e-d]);
                    else{
                        c.push(j._anHidden[e]);
                        d++
                    }
            }
        }
        return c
    }
    function sa(a){
        return a.replace(new RegExp("(\\/|\\.|\\*|\\+|\\?|\\||\\(|\\)|\\[|\\]|\\{|\\}|\\\\|\\$|\\^)",
            "g"),"\\$1")
    }
    function ua(a,b){
        for(var c=-1,d=0,f=a.length;d<f;d++)if(a[d]==b)c=d;else a[d]>b&&a[d]--;c!=-1&&a.splice(c,1)
    }
    function Fa(a,b){
        b=b.split(",");
        for(var c=[],d=0,f=a.aoColumns.length;d<f;d++)for(var e=0;e<f;e++)if(a.aoColumns[d].sName==b[e]){
            c.push(e);
            break
        }
        return c
    }
    function ka(a){
        for(var b="",c=0,d=a.aoColumns.length;c<d;c++)b+=a.aoColumns[c].sName+",";
        if(b.length==d)return"";
        return b.slice(0,-1)
    }
    function J(a,b,c){
        a=a.sTableId===""?"DataTables warning: "+c:"DataTables warning (table id = '"+
        a.sTableId+"'): "+c;
        if(b===0)if(n.sErrMode=="alert")alert(a);else throw a;else typeof console!="undefined"&&typeof console.log!="undefined"&&console.log(a)
    }
    function la(a){
        a.aoData.splice(0,a.aoData.length);
        a.aiDisplayMaster.splice(0,a.aiDisplayMaster.length);
        a.aiDisplay.splice(0,a.aiDisplay.length);
        E(a)
    }
    function va(a){
        if(!(!a.oFeatures.bStateSave||typeof a.bDestroying!="undefined")){
            var b,c,d,f="{";
            f+='"iCreate":'+(new Date).getTime()+",";
            f+='"iStart":'+(a.oScroll.bInfinite?0:a._iDisplayStart)+",";
            f+='"iEnd":'+(a.oScroll.bInfinite?a._iDisplayLength:a._iDisplayEnd)+",";
            f+='"iLength":'+a._iDisplayLength+",";
            f+='"sFilter":"'+encodeURIComponent(a.oPreviousSearch.sSearch)+'",';
            f+='"sFilterEsc":'+!a.oPreviousSearch.bRegex+",";
            f+='"aaSorting":[ ';
            for(b=0;b<a.aaSorting.length;b++)f+="["+a.aaSorting[b][0]+',"'+a.aaSorting[b][1]+'"],';
            f=f.substring(0,f.length-1);
            f+="],";
            f+='"aaSearchCols":[ ';
            for(b=0;b<a.aoPreSearchCols.length;b++)f+='["'+encodeURIComponent(a.aoPreSearchCols[b].sSearch)+'",'+!a.aoPreSearchCols[b].bRegex+
                "],";
            f=f.substring(0,f.length-1);
            f+="],";
            f+='"abVisCols":[ ';
            for(b=0;b<a.aoColumns.length;b++)f+=a.aoColumns[b].bVisible+",";
            f=f.substring(0,f.length-1);
            f+="]";
            b=0;
            for(c=a.aoStateSave.length;b<c;b++){
                d=a.aoStateSave[b].fn(a,f);
                if(d!=="")f=d
            }
            f+="}";
            Wa(a.sCookiePrefix+a.sInstance,f,a.iCookieDuration,a.sCookiePrefix,a.fnCookieCallback)
        }
    }
    function Xa(a,b){
        if(a.oFeatures.bStateSave){
            var c,d,f;
            d=wa(a.sCookiePrefix+a.sInstance);
            if(d!==null&&d!==""){
                try{
                    c=typeof i.parseJSON=="function"?i.parseJSON(d.replace(/'/g,
                        '"')):eval("("+d+")")
                }catch(e){
                    return
                }
                d=0;
                for(f=a.aoStateLoad.length;d<f;d++)if(!a.aoStateLoad[d].fn(a,c))return;a.oLoadedState=i.extend(true,{},c);
                a._iDisplayStart=c.iStart;
                a.iInitDisplayStart=c.iStart;
                a._iDisplayEnd=c.iEnd;
                a._iDisplayLength=c.iLength;
                a.oPreviousSearch.sSearch=decodeURIComponent(c.sFilter);
                a.aaSorting=c.aaSorting.slice();
                a.saved_aaSorting=c.aaSorting.slice();
                if(typeof c.sFilterEsc!="undefined")a.oPreviousSearch.bRegex=!c.sFilterEsc;
                if(typeof c.aaSearchCols!="undefined")for(d=0;d<
                    c.aaSearchCols.length;d++)a.aoPreSearchCols[d]={
                    sSearch:decodeURIComponent(c.aaSearchCols[d][0]),
                    bRegex:!c.aaSearchCols[d][1]
                };

                if(typeof c.abVisCols!="undefined"){
                    b.saved_aoColumns=[];
                    for(d=0;d<c.abVisCols.length;d++){
                        b.saved_aoColumns[d]={};

                        b.saved_aoColumns[d].bVisible=c.abVisCols[d]
                    }
                }
            }
        }
    }
    function Wa(a,b,c,d,f){
        var e=new Date;
        e.setTime(e.getTime()+c*1E3);
        c=za.location.pathname.split("/");
        a=a+"_"+c.pop().replace(/[\/:]/g,"").toLowerCase();
        var h;
        if(f!==null){
            h=typeof i.parseJSON=="function"?i.parseJSON(b):
            eval("("+b+")");
            b=f(a,h,e.toGMTString(),c.join("/")+"/")
        }else b=a+"="+encodeURIComponent(b)+"; expires="+e.toGMTString()+"; path="+c.join("/")+"/";
        f="";
        e=9999999999999;
        if((wa(a)!==null?p.cookie.length:b.length+p.cookie.length)+10>4096){
            a=p.cookie.split(";");
            for(var j=0,k=a.length;j<k;j++)if(a[j].indexOf(d)!=-1){
                var m=a[j].split("=");
                try{
                    h=eval("("+decodeURIComponent(m[1])+")")
                }catch(u){
                    continue
                }
                if(typeof h.iCreate!="undefined"&&h.iCreate<e){
                    f=m[0];
                    e=h.iCreate
                }
            }
            if(f!=="")p.cookie=f+"=; expires=Thu, 01-Jan-1970 00:00:01 GMT; path="+
                c.join("/")+"/"
        }
        p.cookie=b
    }
    function wa(a){
        var b=za.location.pathname.split("/");
        a=a+"_"+b[b.length-1].replace(/[\/:]/g,"").toLowerCase()+"=";
        b=p.cookie.split(";");
        for(var c=0;c<b.length;c++){
            for(var d=b[c];d.charAt(0)==" ";)d=d.substring(1,d.length);
            if(d.indexOf(a)===0)return decodeURIComponent(d.substring(a.length,d.length))
        }
        return null
    }
    function Y(a,b){
        b=i(b).children("tr");
        var c,d,f,e,h,j,k,m,u=function(L,T,B){
            for(;typeof L[T][B]!="undefined";)B++;
            return B
        };

        a.splice(0,a.length);
        d=0;
        for(j=b.length;d<
            j;d++)a.push([]);
        d=0;
        for(j=b.length;d<j;d++){
            f=0;
            for(k=b[d].childNodes.length;f<k;f++){
                c=b[d].childNodes[f];
                if(c.nodeName.toUpperCase()=="TD"||c.nodeName.toUpperCase()=="TH"){
                    var r=c.getAttribute("colspan")*1,H=c.getAttribute("rowspan")*1;
                    r=!r||r===0||r===1?1:r;
                    H=!H||H===0||H===1?1:H;
                    m=u(a,d,0);
                    for(h=0;h<r;h++)for(e=0;e<H;e++){
                        a[d+e][m+h]={
                            cell:c,
                            unique:r==1?true:false
                        };

                        a[d+e].nTr=b[d]
                    }
                }
            }
        }
    }
    function S(a,b,c){
        var d=[];
        if(typeof c=="undefined"){
            c=a.aoHeader;
            if(typeof b!="undefined"){
                c=[];
                Y(c,b)
            }
        }
        b=0;
        for(var f=c.length;b<f;b++)for(var e=0,h=c[b].length;e<h;e++)if(c[b][e].unique&&(typeof d[e]=="undefined"||!a.bSortCellsTop))d[e]=c[b][e].cell;return d
    }
    function Ya(){
        var a=p.createElement("p"),b=a.style;
        b.width="100%";
        b.height="200px";
        b.padding="0px";
        var c=p.createElement("div");
        b=c.style;
        b.position="absolute";
        b.top="0px";
        b.left="0px";
        b.visibility="hidden";
        b.width="200px";
        b.height="150px";
        b.padding="0px";
        b.overflow="hidden";
        c.appendChild(a);
        p.body.appendChild(c);
        b=a.offsetWidth;
        c.style.overflow="scroll";
        a=a.offsetWidth;
        if(b==a)a=c.clientWidth;
        p.body.removeChild(c);
        return b-a
    }
    function P(a,b,c){
        for(var d=0,f=b.length;d<f;d++)for(var e=0,h=b[d].childNodes.length;e<h;e++)if(b[d].childNodes[e].nodeType==1)typeof c!="undefined"?a(b[d].childNodes[e],c[d].childNodes[e]):a(b[d].childNodes[e])
    }
    function o(a,b,c,d){
        if(typeof d=="undefined")d=c;
        if(typeof b[c]!="undefined")a[d]=b[c]
    }
    function fa(a,b,c){
        for(var d=[],f=0,e=a.aoColumns.length;f<e;f++)d.push(G(a,b,f,c));
        return d
    }
    function G(a,b,c,d){
        var f=a.aoColumns[c];
        if((c=f.fnGetData(a.aoData[b]._aData))===undefined){
            if(a.iDrawError!=a.iDraw&&f.sDefaultContent===null){
                J(a,0,"Requested unknown parameter '"+f.mDataProp+"' from the data source for row "+b);
                a.iDrawError=a.iDraw
            }
            return f.sDefaultContent
        }
        if(c===null&&f.sDefaultContent!==null)c=f.sDefaultContent;
        else if(typeof c=="function")return c();
        if(d=="display"&&c===null)return"";
        return c
    }
    function O(a,b,c,d){
        a.aoColumns[c].fnSetData(a.aoData[b]._aData,d)
    }
    function aa(a){
        if(a===null)return function(){
            return null
        };
        else if(typeof a=="function")return function(c){
            return a(c)
        };
        else if(typeof a=="string"&&a.indexOf(".")!=-1){
            var b=a.split(".");
            return b.length==2?function(c){
                return c[b[0]][b[1]]
            }:b.length==3?function(c){
                return c[b[0]][b[1]][b[2]]
            }:function(c){
                for(var d=0,f=b.length;d<f;d++)c=c[b[d]];
                return c
            }
        }else return function(c){
            return c[a]
        }
    }
    function Ba(a){
        if(a===null)return function(){};
        else if(typeof a=="function")return function(c,d){
            return a(c,d)
        };
        else if(typeof a=="string"&&a.indexOf(".")!=-1){
            var b=a.split(".");
            return b.length==2?function(c,d){
                c[b[0]][b[1]]=d
            }:b.length==3?function(c,d){
                c[b[0]][b[1]][b[2]]=d
            }:function(c,d){
                for(var f=0,e=b.length-1;f<e;f++)c=c[b[f]];
                c[b[b.length-1]]=d
            }
        }else return function(c,d){
            c[a]=d
        }
    }
    this.oApi={};

    this.fnDraw=function(a){
        var b=A(this[n.iApiIndex]);
        if(typeof a!="undefined"&&a===false){
            E(b);
            C(b)
        }else da(b)
    };

    this.fnFilter=function(a,b,c,d,f){
        var e=A(this[n.iApiIndex]);
        if(e.oFeatures.bFilter){
            if(typeof c=="undefined")c=false;
            if(typeof d=="undefined")d=true;
            if(typeof f=="undefined")f=
                true;
            if(typeof b=="undefined"||b===null){
                N(e,{
                    sSearch:a,
                    bRegex:c,
                    bSmart:d
                },1);
                if(f&&typeof e.aanFeatures.f!="undefined"){
                    b=e.aanFeatures.f;
                    c=0;
                    for(d=b.length;c<d;c++)i("input",b[c]).val(a)
                }
            }else{
                e.aoPreSearchCols[b].sSearch=a;
                e.aoPreSearchCols[b].bRegex=c;
                e.aoPreSearchCols[b].bSmart=d;
                N(e,e.oPreviousSearch,1)
            }
        }
    };

    this.fnSettings=function(){
        return A(this[n.iApiIndex])
    };

    this.fnVersionCheck=n.fnVersionCheck;
    this.fnSort=function(a){
        var b=A(this[n.iApiIndex]);
        b.aaSorting=a;
        R(b)
    };

    this.fnSortListener=function(a,
        b,c){
        ja(A(this[n.iApiIndex]),a,b,c)
    };

    this.fnAddData=function(a,b){
        if(a.length===0)return[];
        var c=[],d,f=A(this[n.iApiIndex]);
        if(typeof a[0]=="object")for(var e=0;e<a.length;e++){
            d=v(f,a[e]);
            if(d==-1)return c;
            c.push(d)
        }else{
            d=v(f,a);
            if(d==-1)return c;
            c.push(d)
        }
        f.aiDisplay=f.aiDisplayMaster.slice();
        if(typeof b=="undefined"||b)da(f);
        return c
    };

    this.fnDeleteRow=function(a,b,c){
        var d=A(this[n.iApiIndex]);
        a=typeof a=="object"?W(d,a):a;
        var f=d.aoData.splice(a,1),e=i.inArray(a,d.aiDisplay);
        d.asDataSearch.splice(e,
            1);
        ua(d.aiDisplayMaster,a);
        ua(d.aiDisplay,a);
        typeof b=="function"&&b.call(this,d,f);
        if(d._iDisplayStart>=d.aiDisplay.length){
            d._iDisplayStart-=d._iDisplayLength;
            if(d._iDisplayStart<0)d._iDisplayStart=0
        }
        if(typeof c=="undefined"||c){
            E(d);
            C(d)
        }
        return f
    };

    this.fnClearTable=function(a){
        var b=A(this[n.iApiIndex]);
        la(b);
        if(typeof a=="undefined"||a)C(b)
    };

    this.fnOpen=function(a,b,c){
        var d=A(this[n.iApiIndex]);
        this.fnClose(a);
        var f=p.createElement("tr"),e=p.createElement("td");
        f.appendChild(e);
        e.className=c;
        e.colSpan=Z(d);
        if(typeof b.jquery!="undefined"||typeof b=="object")e.appendChild(b);else e.innerHTML=b;
        b=i("tr",d.nTBody);
        i.inArray(a,b)!=-1&&i(f).insertAfter(a);
        d.aoOpenRows.push({
            nTr:f,
            nParent:a
        });
        return f
    };

    this.fnClose=function(a){
        for(var b=A(this[n.iApiIndex]),c=0;c<b.aoOpenRows.length;c++)if(b.aoOpenRows[c].nParent==a){
            (a=b.aoOpenRows[c].nTr.parentNode)&&a.removeChild(b.aoOpenRows[c].nTr);
            b.aoOpenRows.splice(c,1);
            return 0
        }
        return 1
    };

    this.fnGetData=function(a,b){
        var c=A(this[n.iApiIndex]);
        if(typeof a!=
            "undefined"){
            a=typeof a=="object"?W(c,a):a;
            if(typeof b!="undefined")return G(c,a,b,"");
            return typeof c.aoData[a]!="undefined"?c.aoData[a]._aData:null
        }
        return ca(c)
    };

    this.fnGetNodes=function(a){
        var b=A(this[n.iApiIndex]);
        if(typeof a!="undefined")return typeof b.aoData[a]!="undefined"?b.aoData[a].nTr:null;
        return ba(b)
    };

    this.fnGetPosition=function(a){
        var b=A(this[n.iApiIndex]),c=a.nodeName.toUpperCase();
        if(c=="TR")return W(b,a);
        else if(c=="TD"||c=="TH"){
            c=W(b,a.parentNode);
            for(var d=Q(b,c),f=0;f<b.aoColumns.length;f++)if(d[f]==
                a)return[c,ta(b,f),f]
        }
        return null
    };

    this.fnUpdate=function(a,b,c,d,f){
        var e=A(this[n.iApiIndex]);
        b=typeof b=="object"?W(e,b):b;
        if(i.isArray(a)&&typeof a=="object"){
            e.aoData[b]._aData=a.slice();
            for(c=0;c<e.aoColumns.length;c++)this.fnUpdate(G(e,b,c),b,c,false,false)
        }else if(a!==null&&typeof a=="object"){
            e.aoData[b]._aData=i.extend(true,{},a);
            for(c=0;c<e.aoColumns.length;c++)this.fnUpdate(G(e,b,c),b,c,false,false)
        }else{
            a=a;
            O(e,b,c,a);
            if(e.aoColumns[c].fnRender!==null){
                a=e.aoColumns[c].fnRender({
                    iDataRow:b,
                    iDataColumn:c,
                    aData:e.aoData[b]._aData,
                    oSettings:e
                });
                e.aoColumns[c].bUseRendered&&O(e,b,c,a)
            }
            if(e.aoData[b].nTr!==null)Q(e,b)[c].innerHTML=a
        }
        c=i.inArray(b,e.aiDisplay);
        e.asDataSearch[c]=ra(e,fa(e,b,"filter"));
        if(typeof f=="undefined"||f)ea(e);
        if(typeof d=="undefined"||d)da(e);
        return 0
    };

    this.fnSetColumnVis=function(a,b,c){
        var d=A(this[n.iApiIndex]),f,e;
        e=d.aoColumns.length;
        var h,j;
        if(d.aoColumns[a].bVisible!=b){
            if(b){
                for(f=j=0;f<a;f++)d.aoColumns[f].bVisible&&j++;
                j=j>=Z(d);
                if(!j)for(f=a;f<e;f++)if(d.aoColumns[f].bVisible){
                    h=
                    f;
                    break
                }
                f=0;
                for(e=d.aoData.length;f<e;f++)if(d.aoData[f].nTr!==null)j?d.aoData[f].nTr.appendChild(d.aoData[f]._anHidden[a]):d.aoData[f].nTr.insertBefore(d.aoData[f]._anHidden[a],Q(d,f)[h])
            }else{
                f=0;
                for(e=d.aoData.length;f<e;f++)if(d.aoData[f].nTr!==null){
                    h=Q(d,f)[a];
                    d.aoData[f]._anHidden[a]=h;
                    h.parentNode.removeChild(h)
                }
            }
            d.aoColumns[a].bVisible=b;
            M(d,d.aoHeader);
            d.nTFoot&&M(d,d.aoFooter);
            f=0;
            for(e=d.aoOpenRows.length;f<e;f++)d.aoOpenRows[f].nTr.colSpan=Z(d);
            if(typeof c=="undefined"||c){
                ea(d);
                C(d)
            }
            va(d)
        }
    };
    this.fnPageChange=function(a,b){
        var c=A(this[n.iApiIndex]);
        ma(c,a);
        E(c);
        if(typeof b=="undefined"||b)C(c)
    };

    this.fnDestroy=function(){
        var a=A(this[n.iApiIndex]),b=a.nTableWrapper.parentNode,c=a.nTBody,d,f;
        a.bDestroying=true;
        d=0;
        for(f=a.aoDestroyCallback.length;d<f;d++)a.aoDestroyCallback[d].fn();
        d=0;
        for(f=a.aoColumns.length;d<f;d++)a.aoColumns[d].bVisible===false&&this.fnSetColumnVis(d,true);
        i(a.nTableWrapper).find("*").andSelf().unbind(".DT");
        i("tbody>tr>td."+a.oClasses.sRowEmpty,a.nTable).parent().remove();
        if(a.nTable!=a.nTHead.parentNode){
            i(a.nTable).children("thead").remove();
            a.nTable.appendChild(a.nTHead)
        }
        if(a.nTFoot&&a.nTable!=a.nTFoot.parentNode){
            i(a.nTable).children("tfoot").remove();
            a.nTable.appendChild(a.nTFoot)
        }
        a.nTable.parentNode.removeChild(a.nTable);
        i(a.nTableWrapper).remove();
        a.aaSorting=[];
        a.aaSortingFixed=[];
        V(a);
        i(ba(a)).removeClass(a.asStripeClasses.join(" "));
        if(a.bJUI){
            i("th",a.nTHead).removeClass([n.oStdClasses.sSortable,n.oJUIClasses.sSortableAsc,n.oJUIClasses.sSortableDesc,n.oJUIClasses.sSortableNone].join(" "));
            i("th span."+n.oJUIClasses.sSortIcon,a.nTHead).remove();
            i("th",a.nTHead).each(function(){
                var e=i("div."+n.oJUIClasses.sSortJUIWrapper,this),h=e.contents();
                i(this).append(h);
                e.remove()
            })
        }else i("th",a.nTHead).removeClass([n.oStdClasses.sSortable,n.oStdClasses.sSortableAsc,n.oStdClasses.sSortableDesc,n.oStdClasses.sSortableNone].join(" "));
        a.nTableReinsertBefore?b.insertBefore(a.nTable,a.nTableReinsertBefore):b.appendChild(a.nTable);
        d=0;
        for(f=a.aoData.length;d<f;d++)a.aoData[d].nTr!==null&&c.appendChild(a.aoData[d].nTr);
        if(a.oFeatures.bAutoWidth===true)a.nTable.style.width=q(a.sDestroyWidth);
        i(c).children("tr:even").addClass(a.asDestroyStripes[0]);
        i(c).children("tr:odd").addClass(a.asDestroyStripes[1]);
        d=0;
        for(f=D.length;d<f;d++)D[d]==a&&D.splice(d,1);
        a=null
    };

    this.fnAdjustColumnSizing=function(a){
        var b=A(this[n.iApiIndex]);
        ea(b);
        if(typeof a=="undefined"||a)this.fnDraw(false);
        else if(b.oScroll.sX!==""||b.oScroll.sY!=="")this.oApi._fnScrollDraw(b)
    };

    for(var xa in n.oApi)if(xa)this[xa]=s(xa);this.oApi._fnExternApiFunc=
    s;
    this.oApi._fnInitialise=t;
    this.oApi._fnInitComplete=w;
    this.oApi._fnLanguageProcess=y;
    this.oApi._fnAddColumn=F;
    this.oApi._fnColumnOptions=x;
    this.oApi._fnAddData=v;
    this.oApi._fnCreateTr=z;
    this.oApi._fnGatherData=$;
    this.oApi._fnBuildHead=X;
    this.oApi._fnDrawHead=M;
    this.oApi._fnDraw=C;
    this.oApi._fnReDraw=da;
    this.oApi._fnAjaxUpdate=Ca;
    this.oApi._fnAjaxParameters=Da;
    this.oApi._fnAjaxUpdateDraw=Ea;
    this.oApi._fnServerParams=ha;
    this.oApi._fnAddOptionsHtml=Aa;
    this.oApi._fnFeatureHtmlTable=Ja;
    this.oApi._fnScrollDraw=
    Ma;
    this.oApi._fnAdjustColumnSizing=ea;
    this.oApi._fnFeatureHtmlFilter=Ha;
    this.oApi._fnFilterComplete=N;
    this.oApi._fnFilterCustom=Qa;
    this.oApi._fnFilterColumn=Pa;
    this.oApi._fnFilter=Oa;
    this.oApi._fnBuildSearchArray=oa;
    this.oApi._fnBuildSearchRow=ra;
    this.oApi._fnFilterCreateSearch=pa;
    this.oApi._fnDataToSearch=qa;
    this.oApi._fnSort=R;
    this.oApi._fnSortAttachListener=ja;
    this.oApi._fnSortingClasses=V;
    this.oApi._fnFeatureHtmlPaginate=La;
    this.oApi._fnPageChange=ma;
    this.oApi._fnFeatureHtmlInfo=Ka;
    this.oApi._fnUpdateInfo=
    Ra;
    this.oApi._fnFeatureHtmlLength=Ga;
    this.oApi._fnFeatureHtmlProcessing=Ia;
    this.oApi._fnProcessingDisplay=K;
    this.oApi._fnVisibleToColumnIndex=Na;
    this.oApi._fnColumnIndexToVisible=ta;
    this.oApi._fnNodeToDataIndex=W;
    this.oApi._fnVisbleColumns=Z;
    this.oApi._fnCalculateEnd=E;
    this.oApi._fnConvertToWidth=Sa;
    this.oApi._fnCalculateColumnWidths=ga;
    this.oApi._fnScrollingWidthAdjust=Ua;
    this.oApi._fnGetWidestNode=Ta;
    this.oApi._fnGetMaxLenString=Va;
    this.oApi._fnStringToCss=q;
    this.oApi._fnArrayCmp=Za;
    this.oApi._fnDetectType=
    ia;
    this.oApi._fnSettingsFromNode=A;
    this.oApi._fnGetDataMaster=ca;
    this.oApi._fnGetTrNodes=ba;
    this.oApi._fnGetTdNodes=Q;
    this.oApi._fnEscapeRegex=sa;
    this.oApi._fnDeleteIndex=ua;
    this.oApi._fnReOrderIndex=Fa;
    this.oApi._fnColumnOrdering=ka;
    this.oApi._fnLog=J;
    this.oApi._fnClearTable=la;
    this.oApi._fnSaveState=va;
    this.oApi._fnLoadState=Xa;
    this.oApi._fnCreateCookie=Wa;
    this.oApi._fnReadCookie=wa;
    this.oApi._fnDetectHeader=Y;
    this.oApi._fnGetUniqueThs=S;
    this.oApi._fnScrollBarWidth=Ya;
    this.oApi._fnApplyToChildren=
    P;
    this.oApi._fnMap=o;
    this.oApi._fnGetRowData=fa;
    this.oApi._fnGetCellData=G;
    this.oApi._fnSetCellData=O;
    this.oApi._fnGetObjectDataFn=aa;
    this.oApi._fnSetObjectDataFn=Ba;
    var ya=this;
    return this.each(function(){
        var a=0,b,c,d,f;
        a=0;
        for(b=D.length;a<b;a++){
            if(D[a].nTable==this)if(typeof g=="undefined"||typeof g.bRetrieve!="undefined"&&g.bRetrieve===true)return D[a].oInstance;
                else if(typeof g.bDestroy!="undefined"&&g.bDestroy===true){
                    D[a].oInstance.fnDestroy();
                    break
                }else{
                    J(D[a],0,"Cannot reinitialise DataTable.\n\nTo retrieve the DataTables object for this table, please pass either no arguments to the dataTable() function, or set bRetrieve to true. Alternatively, to destory the old table and create a new one, set bDestroy to true (note that a lot of changes to the configuration can be made through the API which is usually much faster).");
                    return
                }
            if(D[a].sTableId!==""&&D[a].sTableId==this.getAttribute("id")){
                D.splice(a,1);
                break
            }
        }
        var e=new l;
        D.push(e);
        var h=false,j=false;
        a=this.getAttribute("id");
        if(a!==null){
            e.sTableId=a;
            e.sInstance=a
        }else e.sInstance=n._oExternConfig.iNextUnique++;
        if(this.nodeName.toLowerCase()!="table")J(e,0,"Attempted to initialise DataTables on a node which is not a table: "+this.nodeName);
        else{
            e.nTable=this;
            e.oInstance=ya.length==1?ya:i(this).dataTable();
            e.oApi=ya.oApi;
            e.sDestroyWidth=i(this).width();
            if(typeof g!=
                "undefined"&&g!==null){
                e.oInit=g;
                o(e.oFeatures,g,"bPaginate");
                o(e.oFeatures,g,"bLengthChange");
                o(e.oFeatures,g,"bFilter");
                o(e.oFeatures,g,"bSort");
                o(e.oFeatures,g,"bInfo");
                o(e.oFeatures,g,"bProcessing");
                o(e.oFeatures,g,"bAutoWidth");
                o(e.oFeatures,g,"bSortClasses");
                o(e.oFeatures,g,"bServerSide");
                o(e.oFeatures,g,"bDeferRender");
                o(e.oScroll,g,"sScrollX","sX");
                o(e.oScroll,g,"sScrollXInner","sXInner");
                o(e.oScroll,g,"sScrollY","sY");
                o(e.oScroll,g,"bScrollCollapse","bCollapse");
                o(e.oScroll,g,"bScrollInfinite",
                    "bInfinite");
                o(e.oScroll,g,"iScrollLoadGap","iLoadGap");
                o(e.oScroll,g,"bScrollAutoCss","bAutoCss");
                o(e,g,"asStripClasses","asStripeClasses");
                o(e,g,"asStripeClasses");
                o(e,g,"fnPreDrawCallback");
                o(e,g,"fnRowCallback");
                o(e,g,"fnHeaderCallback");
                o(e,g,"fnFooterCallback");
                o(e,g,"fnCookieCallback");
                o(e,g,"fnInitComplete");
                o(e,g,"fnServerData");
                o(e,g,"fnFormatNumber");
                o(e,g,"aaSorting");
                o(e,g,"aaSortingFixed");
                o(e,g,"aLengthMenu");
                o(e,g,"sPaginationType");
                o(e,g,"sAjaxSource");
                o(e,g,"sAjaxDataProp");
                o(e,
                    g,"iCookieDuration");
                o(e,g,"sCookiePrefix");
                o(e,g,"sDom");
                o(e,g,"bSortCellsTop");
                o(e,g,"oSearch","oPreviousSearch");
                o(e,g,"aoSearchCols","aoPreSearchCols");
                o(e,g,"iDisplayLength","_iDisplayLength");
                o(e,g,"bJQueryUI","bJUI");
                o(e.oLanguage,g,"fnInfoCallback");
                typeof g.fnDrawCallback=="function"&&e.aoDrawCallback.push({
                    fn:g.fnDrawCallback,
                    sName:"user"
                });
                typeof g.fnServerParams=="function"&&e.aoServerParams.push({
                    fn:g.fnServerParams,
                    sName:"user"
                });
                typeof g.fnStateSaveCallback=="function"&&e.aoStateSave.push({
                    fn:g.fnStateSaveCallback,
                    sName:"user"
                });
                typeof g.fnStateLoadCallback=="function"&&e.aoStateLoad.push({
                    fn:g.fnStateLoadCallback,
                    sName:"user"
                });
                if(e.oFeatures.bServerSide&&e.oFeatures.bSort&&e.oFeatures.bSortClasses)e.aoDrawCallback.push({
                    fn:V,
                    sName:"server_side_sort_classes"
                });else e.oFeatures.bDeferRender&&e.aoDrawCallback.push({
                    fn:V,
                    sName:"defer_sort_classes"
                });
                if(typeof g.bJQueryUI!="undefined"&&g.bJQueryUI){
                    e.oClasses=n.oJUIClasses;
                    if(typeof g.sDom=="undefined")e.sDom='<"H"lfr>t<"F"ip>'
                }
                if(e.oScroll.sX!==""||e.oScroll.sY!==
                    "")e.oScroll.iBarWidth=Ya();
                if(typeof g.iDisplayStart!="undefined"&&typeof e.iInitDisplayStart=="undefined"){
                    e.iInitDisplayStart=g.iDisplayStart;
                    e._iDisplayStart=g.iDisplayStart
                }
                if(typeof g.bStateSave!="undefined"){
                    e.oFeatures.bStateSave=g.bStateSave;
                    Xa(e,g);
                    e.aoDrawCallback.push({
                        fn:va,
                        sName:"state_save"
                    })
                }
                if(typeof g.iDeferLoading!="undefined"){
                    e.bDeferLoading=true;
                    e._iRecordsTotal=g.iDeferLoading;
                    e._iRecordsDisplay=g.iDeferLoading
                }
                if(typeof g.aaData!="undefined")j=true;
                if(typeof g!="undefined"&&
                    typeof g.aoData!="undefined")g.aoColumns=g.aoData;
                if(typeof g.oLanguage!="undefined")if(typeof g.oLanguage.sUrl!="undefined"&&g.oLanguage.sUrl!==""){
                    e.oLanguage.sUrl=g.oLanguage.sUrl;
                    i.getJSON(e.oLanguage.sUrl,null,function(u){
                        y(e,u,true)
                    });
                    h=true
                }else y(e,g.oLanguage,false)
            }else g={};

            if(typeof g.asStripClasses=="undefined"&&typeof g.asStripeClasses=="undefined"){
                e.asStripeClasses.push(e.oClasses.sStripeOdd);
                e.asStripeClasses.push(e.oClasses.sStripeEven)
            }
            c=false;
            d=i(this).children("tbody").children("tr");
            a=0;
            for(b=e.asStripeClasses.length;a<b;a++)if(d.filter(":lt(2)").hasClass(e.asStripeClasses[a])){
                c=true;
                break
            }
            if(c){
                e.asDestroyStripes=["",""];
                if(i(d[0]).hasClass(e.oClasses.sStripeOdd))e.asDestroyStripes[0]+=e.oClasses.sStripeOdd+" ";
                if(i(d[0]).hasClass(e.oClasses.sStripeEven))e.asDestroyStripes[0]+=e.oClasses.sStripeEven;
                if(i(d[1]).hasClass(e.oClasses.sStripeOdd))e.asDestroyStripes[1]+=e.oClasses.sStripeOdd+" ";
                if(i(d[1]).hasClass(e.oClasses.sStripeEven))e.asDestroyStripes[1]+=e.oClasses.sStripeEven;
                d.removeClass(e.asStripeClasses.join(" "))
            }
            c=[];
            var k;
            a=this.getElementsByTagName("thead");
            if(a.length!==0){
                Y(e.aoHeader,a[0]);
                c=S(e)
            }
            if(typeof g.aoColumns=="undefined"){
                k=[];
                a=0;
                for(b=c.length;a<b;a++)k.push(null)
            }else k=g.aoColumns;
            a=0;
            for(b=k.length;a<b;a++){
                if(typeof g.saved_aoColumns!="undefined"&&g.saved_aoColumns.length==b){
                    if(k[a]===null)k[a]={};

                    k[a].bVisible=g.saved_aoColumns[a].bVisible
                }
                F(e,c?c[a]:null)
            }
            if(typeof g.aoColumnDefs!="undefined")for(a=g.aoColumnDefs.length-1;a>=0;a--){
                var m=
                g.aoColumnDefs[a].aTargets;
                i.isArray(m)||J(e,1,"aTargets must be an array of targets, not a "+typeof m);
                c=0;
                for(d=m.length;c<d;c++)if(typeof m[c]=="number"&&m[c]>=0){
                    for(;e.aoColumns.length<=m[c];)F(e);
                    x(e,m[c],g.aoColumnDefs[a])
                }else if(typeof m[c]=="number"&&m[c]<0)x(e,e.aoColumns.length+m[c],g.aoColumnDefs[a]);
                    else if(typeof m[c]=="string"){
                        b=0;
                        for(f=e.aoColumns.length;b<f;b++)if(m[c]=="_all"||i(e.aoColumns[b].nTh).hasClass(m[c]))x(e,b,g.aoColumnDefs[a])
                    }
            }
            if(typeof k!="undefined"){
                a=0;
                for(b=k.length;a<
                    b;a++)x(e,a,k[a])
            }
            a=0;
            for(b=e.aaSorting.length;a<b;a++){
                if(e.aaSorting[a][0]>=e.aoColumns.length)e.aaSorting[a][0]=0;
                k=e.aoColumns[e.aaSorting[a][0]];
                if(typeof e.aaSorting[a][2]=="undefined")e.aaSorting[a][2]=0;
                if(typeof g.aaSorting=="undefined"&&typeof e.saved_aaSorting=="undefined")e.aaSorting[a][1]=k.asSorting[0];
                c=0;
                for(d=k.asSorting.length;c<d;c++)if(e.aaSorting[a][1]==k.asSorting[c]){
                    e.aaSorting[a][2]=c;
                    break
                }
            }
            V(e);
            a=i(this).children("thead");
            if(a.length===0){
                a=[p.createElement("thead")];
                this.appendChild(a[0])
            }
            e.nTHead=
            a[0];
            a=i(this).children("tbody");
            if(a.length===0){
                a=[p.createElement("tbody")];
                this.appendChild(a[0])
            }
            e.nTBody=a[0];
            a=i(this).children("tfoot");
            if(a.length>0){
                e.nTFoot=a[0];
                Y(e.aoFooter,e.nTFoot)
            }
            if(j)for(a=0;a<g.aaData.length;a++)v(e,g.aaData[a]);else $(e);
            e.aiDisplay=e.aiDisplayMaster.slice();
            e.bInitialised=true;
            h===false&&t(e)
        }
    })
}
})(jQuery,window,document);
