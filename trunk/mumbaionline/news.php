<?php
$itemNum=0;
class RSSParser	{
	var $channel_title="";
	var $channel_website="";
	var $channel_description="";
	var $channel_pubDate="";
	var $channel_lastUpdated="";
	var $channel_copyright="";
	var $title="";
	var $link="";
	var $description="";
	var $pubDate="";
	var $author="";
	var $url="";
	var $width="";
	var $height="";
	var $inside_tag=false;	
	function RSSParser($file)	{
			$this->xml_parser = xml_parser_create();
			xml_set_object( $this->xml_parser, &$this );
			xml_set_element_handler( $this->xml_parser, "startElement", "endElement" );
			xml_set_character_data_handler( $this->xml_parser, "characterData" );
			$fp = @fopen("$file","r") or die( "$file could not be opened" );
			while ($data = fread($fp, 4096)){xml_parse( $this->xml_parser, $data, feof($fp)) or die( "XML error");}
			fclose($fp);
			xml_parser_free( $this->xml_parser );
		}
	
	function startElement($parser,$tag,$attributes=''){
		$this->current_tag=$tag;
		if($this->current_tag=="ITEM" || $this->current_tag=="IMAGE"){
			$this->inside_tag=true;
			$this->description="";
			$this->link="";
			$this->title="";
			$this->pubDate="";
		}
	}
	
	function endElement($parser, $tag){
		switch($tag){
			case "ITEM":
				$this->titles[]=trim($this->title);
				$this->links[]=trim($this->link);
				$this->descriptions[]=trim($this->description);
				$this->pubDates[]=trim($this->pubDate);
				$this->authors[]=trim($this->author);
				$this->author=""; $this->inside_tag=false;
				break;
			case "IMAGE":
				$this->channel_image="<img src=\"".trim($this->url)."\" width=\"".trim($this->width)."\" height=\"".trim($this->height)."\" alt=\"".trim($this->title)."\" border=\"0\" title=\"".trim($this->title)."\" />";
				$this->title=""; $this->inside_tag=false;
			default:
				break;
		}
	}
	
	function characterData($parser,$data){
		if($this->inside_tag){
			switch($this->current_tag){
				case "TITLE":
					$this->title.=$data; break;
				case "DESCRIPTION":
					$this->description.=$data; break;
				case "LINK":
					$this->link.=$data; break;
				case "URL":
					$this->url.=$data; break;					
				case "WIDTH":
					$this->width.=$data; break;
				case "HEIGHT":
					$this->height.=$data; break;
				case "PUBDATE":
					$this->pubDate.=$data; break;
				case "AUTHOR":
					$this->author.=$data;	break;
				default: break;									
			}//end switch
		}else{
			switch($this->current_tag){
				case "DESCRIPTION":
					$this->channel_description.=$data; break;
				case "TITLE":
					$this->channel_title.=$data; break;
				case "LINK":
					$this->channel_website.=$data; break;
				case "COPYRIGHT":
					$this->channel_copyright.=$data; break;
				case "PUBDATE":
					$this->channel_pubDate.=$data; break;					
				case "LASTBUILDDATE":
					$this->channel_lastUpdated.=$data; break;				
				default:
					break;
			}
		}
	}
}


?>
<style type="text/css">
.description {

}
.description a {
color:blue;
text-decoration:none;

}
.pubdate {
color:green;
font-size:11px;
font-weight:bold;
text-align:right;
}
.title {
	font-family: Verdana;
	font-size: 12px;
	font-weight: normal;
	margin-top:0;
}
.link {
color:blue;
text-decoration:none;
}
</style>
<?php
$myRss = new RSSParser("http://www.mid-day.com/rss_homepage.php?path=news/local/mumbai");
$myRss_RSSmax=0;
if($myRss_RSSmax==0 || $myRss_RSSmax>count($myRss->titles))$myRss_RSSmax=count($myRss->titles);
for($itemNum=0;$itemNum<$myRss_RSSmax;$itemNum++){?>
<h3 class="title"><a href="javascript:;" onclick="tog('one_<?php echo $itemNum; ?>');" class="link"><?php echo $myRss->titles[$itemNum]; ?></a></h3>
<div id="one_<?php echo $itemNum; ?>" style="display:none;">
<p class="description"><?php echo $myRss->descriptions[$itemNum]; ?></p>
<p class="pubdate">Published On: <?php echo $myRss->channel_pubDate; ?> | <a href="<?php echo $myRss->links[$itemNum]; ?>" target="_new" class="link">Read More</a></p></div>
<?php } ?>
<hr />
<?php
$myRss = new RSSParser("http://news.google.com/news?pz=1&ned=us&hl=en&output=rss&q=mumbai");
$myRss_RSSmax=0;
if($myRss_RSSmax==0 || $myRss_RSSmax>count($myRss->titles))$myRss_RSSmax=count($myRss->titles);
for($itemNum=0;$itemNum<$myRss_RSSmax;$itemNum++){?>
<h3 class="title"><a href="javascript:;" onclick="tog('two_<?php echo $itemNum; ?>');" class="link"><?php echo $myRss->titles[$itemNum]; ?></a></h3>
<div id="two_<?php echo $itemNum; ?>" style="display:none;">
<p class="description"><?php echo $myRss->descriptions[$itemNum]; ?></p>
<p class="pubdate">Published On: <?php echo $myRss->pubDates[$itemNum]; ?> | <a href="<?php echo $myRss->links[$itemNum]; ?>" target="_new" class="link">Read More</a></p></div>
<?php } ?>
<hr />

<?php
$myRss = new RSSParser("http://news.google.com/news?pz=1&ned=us&hl=en&output=rss&q=mumbai+gay");
$myRss_RSSmax=0;
if($myRss_RSSmax==0 || $myRss_RSSmax>count($myRss->titles))$myRss_RSSmax=count($myRss->titles);
for($itemNum=0;$itemNum<$myRss_RSSmax;$itemNum++){?>
<h3 class="title"><a href="javascript:;" onclick="tog('three_<?php echo $itemNum; ?>');" class="link"><?php echo $myRss->titles[$itemNum]; ?></a></h3>
<div id="three_<?php echo $itemNum; ?>" style="display:none;">
<p class="description"><?php echo $myRss->descriptions[$itemNum]; ?></p>
<p class="pubdate">Published On: <?php echo $myRss->pubDates[$itemNum]; ?> | <a href="<?php echo $myRss->links[$itemNum]; ?>" target="_new" class="link">Read More</a></p></div>
<?php } ?>