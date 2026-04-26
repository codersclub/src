<style type="text/css">
.news {
    font-face: Tahoma;
}
.announce {
    margin-bottom: 1em;
}
.announce a {
    font-weight: bold;
}
.announce div {
    display: table-row;
}
.announce span {
    display: table-cell;
    vertical-align: top;
}
.img {
    float: left;
    width: 60px;
*    min-height: 60px;
    margin-right: 0.5em;
}
.img img {
    width: 60px;
}
.block {
    font-face: Tahoma;
}
.block header {
    color:#FFF;
    font-face: Tahoma;
    font-size: small;
    font-weight: bold;
}
.block a:before {
    content: •;
}
.page_list {
    text-align: right;
}
.page_list ul {
    margin: 0;
    padding: 0;
    display: inline;  
}
.page_list li {
    display: inline;  
}
</style>
        
<!-- NEWS BAND -->
<div class="news">        

<? $n = $start + 1; ?>    
<? foreach ($news as $row) { ?>
    <? include(_D_ . $row_template); ?>
    <? $n++; ?>    
<? } ?>
    
<? include(_D_ . $paging_template); ?>

</div>
<!-- /NEWS BAND -->
