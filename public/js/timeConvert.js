 function _convertDuration(durationStr) {
    var str = durationStr,
          h = /^PT([0-9]+)H/.exec(str) ? /^PT([0-9]+)H/.exec(str)[1] : 0,
          m = /([0-9]+)M/.exec(str)    ? /([0-9]+)M/.exec(str)[1]    : 0,
          s = /([0-9]+)S$/.exec(str)   ? /([0-9]+)S$/.exec(str)[1]   : 0;

    return parseInt(s, 10) + parseInt(m, 10) * 60 + parseInt(h , 10) * 60 * 60;
  }

 function _convertDurationJapan(durationStr) {
    var str = durationStr,
          h = /^PT([0-9]+)H/.exec(str) ? /^PT([0-9]+)H/.exec(str)[1] : 0,
          m = /([0-9]+)M/.exec(str)    ? /([0-9]+)M/.exec(str)[1]    : 0,
          s = /([0-9]+)S$/.exec(str)   ? /([0-9]+)S$/.exec(str)[1]   : 0;

    return   parseInt(m, 10) +"分"+parseInt(s, 10)+"秒";
  }
  