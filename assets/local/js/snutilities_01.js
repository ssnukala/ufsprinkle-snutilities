String.prototype.ucFirst = function () {
    return this.charAt(0).toUpperCase() + this.slice(1);
};

function getValueIfExists(par_id, par_val)
{
    if (jQuery("#" + par_id).length) {
        return jQuery("#" + par_id).val();
    } else
        return par_val;
}

function setValueIfExists(par_id, par_val)
{
    if (jQuery("#" + par_id).length) {
        jQuery("#" + par_id).val(par_val);
    }
}

function setValueIfExists2(par_id, par_val)
{
    if (jQuery(par_id).length) {
        jQuery(par_id).val(par_val);
    }
}

function setValueIfExists_class(par_id, par_val)
{
    if (jQuery("." + par_id).length) {
        jQuery("." + par_id).each(function () {
            jQuery(this).val(par_val);
        });
    }
}


function setHTMLIfExists(par_id, par_val)
{
    if (jQuery("#" + par_id).length) {
        jQuery("#" + par_id).html(par_val);
    }
}

function setHTMLIfExists_class(par_id, par_val)
{
    if (jQuery("." + par_id).length) {
        jQuery("." + par_id).each(function () {
            jQuery(this).html(par_val);
        });
    }
}
jQuery.fn.serializeJSON = function () {
    var json = {};
    jQuery.map(jQuery(this).serializeArray(), function (n, i) {
        var _ = n.name.indexOf('[');
        if (_ > -1) {
            var o = json;
            _name = n.name.replace(/\]/gi, '').split('[');
            for (var i = 0, len = _name.length; i < len; i++) {
                if (i == len - 1) {
                    if (o[_name[i]]) {
                        if (typeof o[_name[i]] == 'string') {
                            o[_name[i]] = [o[_name[i]]];
                        }
                        o[_name[i]].push(n.value);
                    } else
                        o[_name[i]] = n.value || '';
                } else
                    o = o[_name[i]] = o[_name[i]] || {};
            }
        } else {
            if (json[n.name] !== undefined) {
                if (!json[n.name].push) {
                    json[n.name] = [json[n.name]];
                }
                json[n.name].push(n.value || '');
            } else
                json[n.name] = n.value || '';
        }
    });
    return json;
};

function setupMultiSelect(selectid)
{
    jQuery(selectid).multiselect({
        templates: {// Use the Awesome Bootstrap Checkbox structure
            li: '<li><label><div class="checkbox"></label></div></li>'
        }
    });
    jQuery('.multiselect-container div.checkbox').each(function (index) {

        var id = 'multiselect-' + index,
                $input = jQuery(this).find('input');
        // Associate the label and the input
        jQuery(this).find('label').attr('for', id);
        $input.attr('id', id);
        // Remove the input from the label wrapper
        $input.detach();
        // Place the input back in before the label
        $input.prependTo($(this));
        jQuery(this).click(function (e) {
            // Prevents the click from bubbling up and hiding the dropdown
            e.stopPropagation();
        });
    });


}

function doAnimations(elems) {
    //Cache the animationend event in a variable
    var animEndEv = 'webkitAnimationEnd animationend';
    elems.each(function () {
        var $this = jQuery(this),
                $animationType = $this.data('animation');
        $this.addClass($animationType).one(animEndEv, function () {
            $this.removeClass($animationType);
        });
    });
}