(function(d){function g(a){var b=a||window.event,i=[].slice.call(arguments,1),c=0,h=0,e=0;a=d.event.fix(b);a.type="mousewheel";if(a.originalEvent.wheelDelta)
    c=a.originalEvent.wheelDelta/120;if(a.originalEvent.detail)
    c=-a.originalEvent.detail/3;e=c;if(b.axis!==undefined&&b.axis===b.HORIZONTAL_AXIS){e=0;h=-1*c}
    if(b.wheelDeltaY!==undefined)
        e=b.wheelDeltaY/120;if(b.wheelDeltaX!==undefined)
        h=-1*b.wheelDeltaX/120;i.unshift(a,c,h,e);return d.event.handle.apply(this,i)}
    var f=["DOMMouseScroll","mousewheel"];d.event.special.mousewheel={setup:function(){if(this.addEventListener)
        for(var a=f.length;a;)
            this.addEventListener(f[--a],g,false);else
        this.onmousewheel=g},teardown:function(){if(this.removeEventListener)
        for(var a=f.length;a;)
            this.removeEventListener(f[--a],g,false);else
        this.onmousewheel=null}};d.fn.extend({mousewheel:function(a){return a?this.bind("mousewheel",a):this.trigger("mousewheel")},unmousewheel:function(a){return this.unbind("mousewheel",a)}})})(jQuery);