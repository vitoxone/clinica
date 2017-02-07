var esMovil = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
 	otro: function() {
    	return navigator.userAgent.match(/Mobile/i);
  	},
    cualquiera: function() {
        return esMovil.Android() || esMovil.BlackBerry() || esMovil.iOS() || esMovil.Opera() || esMovil.Windows() || esMovil.otro();
    }
};