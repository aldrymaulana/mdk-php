function loadContent(url) {
  $("#content").load(url);
}

function addTab(id, node, url) {
  if (id.tabs("exists", node))    {
    id.tabs("select", node);
  } else {
    id.tabs("close", 0);
    id.tabs("add", {
      title: node,
      href: url,
      closable: true
    });
  }
}

function changeDateFormat(originalFormatDate) { 
    var splitDate = originalFormatDate.split(" ");
    var mm = splitDate[0];
    var dd = splitDate[1];
    var yy = splitDate[2];

    dd = (dd < 10) ? '0' + dd : dd;
    switch (mm) {
      case "Jan" : mm = "01"; break;
      case "Feb" : mm = "02"; break;
      case "Mar" : mm = "03"; break;
      case "Apr" : mm = "04"; break;
      case "May" : mm = "05"; break;
      case "Jun" : mm = "06"; break;
      case "Jul" : mm = "07"; break;
      case "Aug" : mm = "08"; break;
      case "Sep" : mm = "09"; break;
      case "Oct" : mm = "10"; break;
      case "Nov" : mm = "11"; break;
      case "Dec" : mm = "12"; break;
    }

    return dd + "-" + mm + "-" + yy;
  }
