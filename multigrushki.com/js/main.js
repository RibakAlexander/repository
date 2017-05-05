/* Служебные функции */
function addClass(el, cls){
    if ( isTag(el) && is_string(cls) &&  !hasClass(el, cls) ){
        el.className += " "+cls;
    }
}
function removeClass(el, cls){
    var re = new RegExp('(\\s|^)' + cls + '(\\s|$)');
    el.className = el.className.replace(re, ' ');
}
function hasClass(el, cls){
    return el.className.match(new RegExp('(\\s|^)' + cls + '(\\s|$)'))
}

function isTag(el){
    if ( el.toString().match(new RegExp('object HTML')) !== null ){
        return true;
    } else{
        return false;
    }
}

/**
 * @function change_class
 * @param {HTMLElement}  elem
 * @param {string}       $class1
 * @param {string}       $class2
 * @required             trim()
 */
function change_class(elem, $class1, $class2){
    var $classes = ' '+ elem.className +' ',
        $classes_new = $classes.replace($class1+' ', $class2+' ');

    if (!''.trim) $classes_new = trim($classes_new);
    else $classes_new = $classes_new.trim();

    elem.className = $classes_new;
}

/**
 * @function is_string Проверяет оъект "obj" как String()
 * @param {any} obj
 * Возвращает: true | false
 */
function is_string (obj){
    if (obj.toString == String.prototype.toString) return true;
    return false;
}