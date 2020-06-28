var Cookie = {
  set: function(key,val,expiresDays){
    if(expiresDays){
      var date = new Date();
      date.setTime(date.getTime()+expiresDays*24*3600*1000);
      var expiresStr = "expires="+date.toGMTString()+';';
    } else {
      var expiresStr = '';
    }
    document.cookie = key+'='+escape(val)+';'+expiresStr;
  },
  get: function(key){
    var getCookie = document.cookie.replace(/[ ]/g,'');
    var resArr = getCookie.split('=');
    var res;
    for(var i = 0,len = resArr.length;i < len; i++){
      var arr = resArr[i].split('=');
      if(arr[0]==key){
        res=arr[i];
        break;
      }
    }
    return unescape(res);
  }
};