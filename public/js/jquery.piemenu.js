;(function($) {

	"use strict";

	// plugin name
	var ns = "piemenu";

	// plugin constructor
	$[ns] = function(element, options) {
		// empty arguments
		element = element || {};
		options = options || {};

		// init once
		if ($(element).data("jquery." + ns)) {
			return;
		}

		// only ul
		if ( ! $(element).is("ul")) {
			return;
		}

		// define template elements
		this.$ui = {
			wrapper : $(false),
			content : $(false),
			button  : $(false),
			ul      : $(element)
		};

		// options
		this._options = options;

		// initialize
		this.init();
	}

	// plugin prototype
	$[ns].prototype = {

		/**
		 * Default options
		 *
		 * @type {Object}
		 */
		_defaults: {
			range  : 270,
			center : 0,
			margin : 6
		},

		/**
		 * Fix this._options
		 *
		 * @return {Void}
		 */
		_config: function() {
			var options   = $.extend({}, this._options);
			this._options = $.extend({}, this._defaults);

			for (var key in this._defaults) {
				if (key in options) {
					this.options(key, options[key]);
				}
			}

			for (var key in this._defaults) {
				var value = this.$ui.ul.attr("data-" + ns + "-" + key);
				if (typeof value === "string") {
					this.options(key, value);
				}
			}
		},

		/**
		 * Create template
		 *
		 * @return {Void}
		 */
		_create: function() {
			this.$ui.ul.wrap("<div />");
			this.$ui.content = this.$ui.ul.parent()

			this.$ui.content.wrap("<div />");
			this.$ui.wrapper = this.$ui.content.parent()
				.addClass(ns)
				.addClass( ! this._support("transform")  ? "notransform"  : "_temp")
				.addClass( ! this._support("transition") ? "notransition" : "_temp")
				.removeClass("_temp");

			this.$ui.button = $("<button />")
				.text("Toggle")
				.appendTo(this.$ui.wrapper);
		},

		/**
		 * Bind events
		 *
		 * @return {Void}
		 */
		_bind: function() {
			var that = this;

			// bind click event
			this.$ui.button.on("click", function() {
				that.toggle();
			});
		},

		/**
		 * Detect browser css support
		 *
		 * @param  {String}  property
		 * @return {Boolean}
		 */
		_support: function(property) {
			var element = document.body || document.documentElement;
			var prefix  = ["", "Moz", "webkit", "Webkit", "Khtml", "O", "ms"];

			for (var i = 0; i < prefix.length; i++) {
				if (typeof element.style[prefix[i] + property.charAt(0)[prefix[i] ? "toUpperCase" : "toLowerCase"]() + property.substr(1)] === "string") {
					return true;
				}
			}

			return false;
		},

		/**
		 * Get/set option key
		 *
		 * @param  {String} key
		 * @param  {Mixed}  value
		 * @return {Mixed}
		 */
		options: function(key, value) {
			if (typeof value === "undefined") {
				return typeof key !== "string" || typeof this._options[key] === "undefined" ? null : this._options[key];
			}

			if (key in this._defaults && ! isNaN(value * 1)) {
				this._options[key] = value * 1;

				if (this._options.range  <=   0) this._options.range  = this._defaults.range;
				if (this._options.range  >  360) this._options.range  = 360;
				if (this._options.margin <    0) this._options.margin = 0;

				this.render();
			}
		},

		/**
		 * Set rotate and skew for each element
		 *
		 * @return {Void}
		 */
		render: function() {
			// check new elements
			var that    = this;
			that.$ui.li = that.$ui.ul.children("li");
			that.$ui.a  = that.$ui.li.children("a");

			// calculations
			var range  = that.options("range");
			var margin = that.options("margin");
			var center = that.options("center");
			var length = that.$ui.li.length;
			var slice  = range / length - margin;
			var skew   = 90 - slice;

			// rotate content (set center)
			this.$ui.content.css("transform", center ? "rotate(" + center + "deg)" : "");

			// rotate and skew li elements
			that.$ui.li.css("transform", function() {
				var rotate = 0
					+ range  / -2
					+ margin /  2
					+ that.$ui.li.index(this) * (slice + margin);

				return "rotate(" + rotate + "deg) skewY(" + -1 * skew + "deg)";
			});

			// skew and rotate a elements
			that.$ui.a.css("transform", "skewY(" + skew + "deg) rotate(" + (slice / 2) + "deg)");
		},

		/**
		 * Toggle open/close
		 *
		 * @return {Void}
		 */
		toggle: function() {
			this.$ui.wrapper.toggleClass("active");
			this.$ui.ul.trigger("piemenutoggle");
		},

		/**
		 * Constructor
		 *
		 * @return {Void}
		 */
		init: function() {
			if (this.$ui.ul.data("jquery." + ns)) {
				return;
			}

			this.$ui.ul.data("jquery." + ns, this);

			this._config();
			this._create();
			this._bind();

			this.render();
		},

		/**
		 * Destructor
		 *
		 * @return {Void}
		 */
		destroy: function() {
			// reset rotate/skew
			this.$ui.li.css("transform", "");
			this.$ui.a.css("transform", "");

			// remove plugin
			this.$ui.ul
				.removeData("jquery." + ns)
				.detach()
				.insertAfter(this.$ui.wrapper);

			// remove wrapper
			this.$ui.wrapper
				.remove();

			// clear variables
			this.$ui      = undefined;
			this._options = undefined;
		}

	}

	// jQuery plugin definition
	$.fn[ns] = function(options) {
		var args = arguments, result;

		// each selector loop
		$(this).each(function() {
			var plugin = $(this).data("jquery." + ns);

			// constructor
			if ( ! plugin) {
				plugin = new $[ns](this, options);
			}

			// call plugin public method
			if (plugin && $(this).data("jquery." + ns) && typeof(options) === "string" && typeof(plugin[options]) === "function" && options.substr(0, 1) != "_") {
				result = plugin[options].apply(plugin, Array.prototype.slice.call(args, 1));
			}
		});

		// plugin public method result or this
		return typeof result === "undefined" ? this : result;
	}

	// autoinitialize
	$(document).ready(function() {
		$("[data-" + ns + "-autoinit]")[ns]();
	});

})(jQuery);
