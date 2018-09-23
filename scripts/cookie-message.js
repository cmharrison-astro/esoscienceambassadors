const cookieMessageFunction = () => {
  console.log('HI');
  /**
   * Set cookie
   *
   * @param string name
   * @param string value
   * @param int days
   * @param string path
   * @see http://www.quirksmode.org/js/cookies.html
   */
  function createCookie(name, value, days, path) {
    console.log('HI 3');
    let expires;
    if (days) {
      const date = new Date();
      date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
      expires = '; expires=' + date.toGMTString();
    } else {
      expires = '';
    }
    document.cookie = `${name}=${value}${expires}; path=${path}`;
  }

  /**
   * Read cookie
   * @param string name
   * @returns {*}
   * @see http://www.quirksmode.org/js/cookies.html
   */
  function readCookie(name) {
    const nameEQ = `${name}=`;
    const ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') c = c.substring(1, c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
  }

  const cookieMessage = document.getElementById('cookie-message');
  console.log('cookieMessage: ', cookieMessage);

  if (cookieMessage == null) {
    return;
  }

  const cookie = readCookie('seen-cookie-message');
  console.log('cookie: ', cookie);


  if (cookie != null && cookie == 'yes') {
    cookieMessage.style.display = 'none';
  } else {
    cookieMessage.style.display = 'block';
  }

  // Set/update cookie
  let cookieExpiry = cookieMessage.getAttribute('data-cookie-expiry');
  console.log('cookieExpiry: ', cookieExpiry);


  if (cookieExpiry == null) {
    cookieExpiry = 30;
  }

  let cookiePath = cookieMessage.getAttribute('data-cookie-path');
  console.log('cookiePath: ', cookiePath);

  if (cookiePath == null) {
    cookiePath = '/';
  }

  createCookie('seen-cookie-message', 'yes', cookieExpiry, cookiePath);
};

cookieMessageFunction();
console.log('HI 2');