fetch("/navigation/meta.html")
.then(r => {
    return r.text()
})
.then(a => {
    document.getElementsByTagName("head")[0].innerHTML +=a;
});
