const cookieBannerClose = () => {
  const days = 30;
  const myDate = new Date();
  myDate.setTime(myDate.getTime() + days * 24 * 60 * 60 * 1000);
  const readableDate = myDate.toGMTString();
  document.cookie = `comply_cookie = comply_yes; expires = ${readableDate}`;

  const node = document.getElementById('cookies');
  if (node.parentNode) {
    node.parentNode.removeChild(node);
  }
};
