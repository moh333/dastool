
export function findPos(obj) {
    let curtop = 0;
    if (obj.offsetParent) {
        do {
            curtop += obj.offsetTop;
        } while (obj = obj.offsetParent);
        return [curtop];
    }
}

export function loadScript (scriptUrl) {
    return new Promise((resolve, reject) => {
        const script = document.createElement('script')
        script.async = true
        script.defer = true
        script.src = scriptUrl

        const head = document.head || document.getElementsByTagName('head')[0]
        head.appendChild(script)

        script.onload = resolve
        script.onerror = reject
    })
}

export function getMeta (name) {
    let meta =  document.head.querySelector('meta[property=' + JSON.stringify(name) + ']');
    if(meta) {
        return meta.content;
    }

    return null;
    //return $('meta[property=' + JSON.stringify(name) + ']').attr('content')
}

export function escapeHtml(text) {

    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };

    return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

export const isEmpty = obj => [Object, Array].includes((obj || {}).constructor) && !Object.entries((obj || {})).length;

export function sleep(milliseconds) {
    return new Promise(resolve => setTimeout(resolve, milliseconds));
}

export function empty (mixedVar) {
    let undef
    let key
    let i
    let len
    const emptyValues = [undef, null, false, 0, '', '0']
    for (i = 0, len = emptyValues.length; i < len; i++) {
        if (mixedVar === emptyValues[i]) {
            return true
        }
    }
    if (typeof mixedVar === 'object') {
        for (key in mixedVar) {
            if (mixedVar.hasOwnProperty(key)) {
                return false
            }
        }
        return true
    }
    return false
}

export function nl2br (str, is_xhtml) {
    if (typeof str === 'undefined' || str === null) {
        return '';
    }
    const breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}

export function randomStr() {

    return Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);

}
