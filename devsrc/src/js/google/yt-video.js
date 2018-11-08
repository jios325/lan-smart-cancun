/* Light YouTube Embeds by @labnol */
/* Web: http://labnol.org/?p=27941 */
/* carga un thumbnail e inserta el iframe despues de dar click en play */
document.addEventListener('DOMContentLoaded',
  function () {
    var div, n,
      v = document.getElementsByClassName('youtube-player')
    for (n = 0; n < v.length; n++) {
      div = document.createElement('div')
      div.setAttribute('data-id', v[n].dataset.id)
      div.innerHTML = labnolThumb(v[n].dataset.thumbnail)
      div.onclick = labnolIframe
      v[n].appendChild(div)
    }
  }
)

function labnolThumb (id) {
  console.log(id)
  var thumb = '<img src="' + id + '">',
    play = '<div class="play"><i class="icon icon-play"></i></div>'
  return thumb + play
}

function labnolIframe () {
  var iframe = document.createElement('iframe')
  var embed = 'https://www.youtube.com/embed/ID?autoplay=1&rel=0&showinfo=0'
  iframe.setAttribute('src', embed.replace('ID', this.dataset.id))
  iframe.setAttribute('frameborder', '0')
  iframe.setAttribute('allowfullscreen', '1')
  this.parentNode.replaceChild(iframe, this)
}