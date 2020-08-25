"use strict";

!function ( $ )
{
    "use strict"

    const app = function () {}

    app.prototype.onResize = function ()
    {
        window.addEventListener('resize', function ( e )
        {
            window.requestAnimationFrame(function ()
            {
            })
        })
    },

    app.prototype.test = function ()
    {
    },

    app.prototype.init = function ()
    {
        this.onResize()
    }

    $.app = new app
    $.app.Constructor = app
}( window.jQuery ),

function ( $ )
{
    $.app.init()
}( window.jQuery )
