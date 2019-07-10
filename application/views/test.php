
<?php 
$currentURL = current_url();
print_r($currentURL);
?>
<!--Viber Share Button Meralesson.com-->  
<a id='viber_share'><img src='https://2.bp.blogspot.com/-n9lVHQhMPMw/Vy3IeYXZyII/AAAAAAAABUY/3Fev7BR4c4gCbrhJfu3jOjLSN2DtiWDEwCLcB/s1600/Viber-Icon.png' style='width:32px; height:32px;' title='Share on Viber'/></a>
<script>
    var buttonID = "viber_share";
    var text = "Check this out: ";
    document.getElementById(buttonID)
        .setAttribute('href', "https://3p3x.adj.st/?adjust_t=u783g1_kw9yml&adjust_fallback=https%3A%2F%2Fwww.viber.com%2F%3Futm_source%3DPartner%26utm_medium%3DSharebutton%26utm_campaign%3DDefualt&adjust_campaign=Sharebutton&adjust_deeplink=" + encodeURIComponent("viber://forward?text=" + encodeURIComponent(text + " " + window.location.href)));
</script>



<div id="whatsapp-share">
<a id='whatsapp_share'><img src='https://cdn3.iconfinder.com/data/icons/social-network-30/512/social-01-512.png' style='width:32px; height:32px;' title='Share on whatsapp'/></a>
<a href="https://api.whatsapp.com/send?text=https://stackoverflow.com/questions/49694071/how-to-share-details-to-whatsapp-from-my-website" data-action="share/whatsapp/share" > Share Via whatssapp</a>
	</div>