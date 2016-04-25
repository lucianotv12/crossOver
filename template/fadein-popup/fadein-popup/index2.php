<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<style>
#popup {
    background: none repeat scroll 0 0 #FFFFFF !important;
    border: 1px solid rgba(0, 0, 0, 0.8) !important;
    border-radius: 4px 4px 4px 4px !important;
    box-shadow: 0 4px 40px rgba(0, 0, 0, 0.5) !important;
    overflow: hidden !important;
    padding: 0 !important;
	width:500px;
}

.content_popup_title {
    background: url("images/header-bg.png") repeat-x scroll left center #404040 !important;
    border-bottom: medium none !important;
    border-radius: 4px 4px 0 0 !important;
    box-shadow: 0 1px 0 #868687 inset !important;
    height: 25px;
    line-height: 1 !important;
    overflow: hidden !important;
    padding: 5px;
    padding-left: 5px;
    padding-top: 5px;
    position: relative !important;
    text-align: left !important;
    width: 99% !important;
}

.popup_title {
	float:left;
	color:#CCCCCC;
	font-weight:bold;
	font-size:14px;
}


.popup_close {
	float:right;
	margin-right: 5px;
}

.popup_content {
    padding: 10px !important;
}

.popup_footer {
    background: none repeat scroll 0 0 #F2F2F2 !important;
    border-radius: 0 0 4px 4px !important;
    border-top: 1px solid #AAAAAA !important;
    font-size: 90% !important;
    padding: 5px 0 !important;
    text-align: right !important;
	padding:5px;
}
</style>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('#open').click(function(){
        $('#popup').fadeIn('slow');
		return false;
    });

    $('#close').click(function(){
        $('#popup').fadeOut('slow');
		return false;
    });
});
</script>
</head>

<body>
<div style="height:1200px;">
<a href="#" id="open">Open</a>
    <div id="popup" style="display:none";>                
        <div class="content_popup_title"> 
        	<div class="popup_title">Archivo Adjunto </div>  
            <div class="popup_close"><a href="#" id="close"><img src="images/close.png"/></a></div>                                       
                        
        </div>                
        <div class="popup_content">                      
            <p>parrafo 1</p>  		
            <p>Paror asepoe sgpaose gnosepg naseog pasnog sapgnoas gopnsgo psegnaos gnaog naseog psngo pasgnoas pgn</p>    
        </div>                                
        <div class="popup_footer">                  
           content footer   
        </div>                           
    </div>
</div>
</body>
</html>