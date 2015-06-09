$j(document).ready(function () {
    var value = getQueryStringValue("city"); 
    switch (value) {
        case "4":
            var yhlist = "<a href='ymsgr:sendIM?Kay.vietnam'><img border=0 src='http://opi.yahoo.com/online?u=Kay.vietnam&m=g&t=1' /></a>";
            yhlist += "<a href='ymsgr:sendIM?Kayvn'><img border=0 src='http://opi.yahoo.com/online?u=Kayvn&m=g&t=1' /></a>";
            $j('.yahoo').html(yhlist);
            break;
        case "8":
            var yhlist = "<a href='ymsgr:sendIM?Kay.vietnam'><img border=0 src='http://opi.yahoo.com/online?u=Kay.vietnam&m=g&t=1' /></a>";
            yhlist += "<a href='ymsgr:sendIM?Kayvn'><img border=0 src='http://opi.yahoo.com/online?u=Kayvn&m=g&t=1' /></a>";
            $j('.yahoo').html(yhlist);
            break;
    }
});
