(function ($) {



    $.fn.bootstrapNumber = function (options) {
        var idProducto = options;
        var settings = $.extend({
            center: true
        }, options);

        return this.each(function (e) {
            var self = $(this);
            var clone = self.clone();

            var min = self.attr('min');
            var max = self.attr('max');

            function setText(n) {
                if ((min && n < min) || (max && n > max)) {
                    return false;
                }
                clone.focus().val(n);
                return true;
            }
            var btn = $('<button type="button" data-update="1" name="name' + idProducto + '" data-idProducto="' + idProducto + '" class="btn btn-sm btn-danger" style="width:105px;">Agregar</button>').click(function () {
                if ($(this).attr("data-update") == 1) {
                    setText(1);
                    actualizarCarrito($(this).attr("data-idProducto"), 1);
                } else {
                    $(this).attr("data-update", 1);
                }
                var group = $("<div class='input-group input-group-sm' style='width:105px;'></div>");
                var down = $("<button data-idProducto=" + idProducto + " type='button'>-</button>").attr('class', 'btn ').click(function () {
                    var cnt = parseInt(clone.val()) - 1;
                    setText(cnt);
                    actualizarCarrito($(this).attr("data-idProducto"), cnt);
                });
                var up = $("<button data-idProducto=" + idProducto + " type='button'>+</button>").attr('class', 'btn btn-success').click(function () {
                    var cnt = parseInt(clone.val()) + 1;
                    setText(cnt);
                    actualizarCarrito($(this).attr("data-idProducto"), cnt);
                    group.attr('style', 'width:105px;');
                });
                $("<span class='input-group-btn'></span>").append(down).appendTo(group);
                clone.appendTo(group);
                if (clone) {
                    clone.css('text-align', 'center');
                }
                $("<span class='input-group-btn'></span>").append(up).appendTo(group);
                // remove spins from original
                clone.prop('type', 'text').keydown(function (e) {
                    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                            (e.keyCode == 65 && e.ctrlKey === true) ||
                            (e.keyCode >= 35 && e.keyCode <= 39)) {
                        return;
                    }
                    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                        e.preventDefault();
                    }
                    var c = String.fromCharCode(e.which);
                    var n = parseInt(clone.val() + c);
                });
                clone.prop('type', 'text').blur(function (e) {
                    var c = String.fromCharCode(e.which);
                    var n = parseInt(clone.val() + c);
                    if ((min && n < min)) {
                        setText(min);
                    } else if (max && n > max) {
                        setText(max);
                    }
                });
                clone.css('display', 'inline');
                $(this).replaceWith(group);
            });
            if (clone) {
                clone.css('display', 'none');
            }
            btn.append(clone);
            self.replaceWith(btn);
        });
    };
}(jQuery));
