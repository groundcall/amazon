<div id="page-heading"><h1>Add product</h1></div>

<!--  start message-red -->
<div id="message-red">
    <table border="0" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td class="red-left">Error. <a href="">Please try again.</a></td>
            <td class="red-right"><a class="close-red"><img src="images/table/icon_close_red.gif"   alt="" /></a></td>
        </tr>
    </table>
</div>
<!--  end message-red -->

<!--  start message-green -->
<div id="message-green">
    <table border="0" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td class="green-left">Product added sucessfully. <a href="">Add new one.</a></td>
            <td class="green-right"><a class="close-green"><img src="images/table/icon_close_green.gif"   alt="" /></a></td>
        </tr>
    </table>
</div>
<!--  end message-green -->

<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
    <tr>
        <th rowspan="3" class="sized"><img src="images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
        <th class="topleft"></th>
        <td id="tbl-border-top">&nbsp;</td>
        <th class="topright"></th>
        <th rowspan="3" class="sized"><img src="images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
    </tr>
    <tr>
        <td id="tbl-border-left"></td>
        <td>
            <!--  start content-table-inner -->
            <div id="content-table-inner">

                <table border="0" width="100%" cellpadding="0" cellspacing="0">
                    <tr valign="top">
                        <td>
                            <!-- start id-form -->
                            <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                                <tr>
                                    <th valign="top">Product name:</th>
                                    <td><input type="text" class="inp-form" /></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th valign="top">Product name:</th>
                                    <td><input type="text" class="inp-form-error" /></td>
                                    <td>
                                        <div class="error-left"></div>
                                        <div class="error-inner">This field is required.</div>
                                    </td>
                                </tr>
                                <tr>
                                    <th valign="top">Category:</th>
                                    <td>	
                                        <select>
                                            <option value="">All</option>
                                            <option value="">Products</option>
                                            <option value="">Categories</option>
                                            <option value="">Clients</option>
                                            <option value="">News</option>
                                        </select>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th valign="top">Short description:</th>
                                    <td>	
                                        <input type="text" class="inp-form" />
                                    </td>
                                    <td></td>
                                </tr> 
                                <tr>
                                    <th valign="top">Price:</th>
                                    <td><input type="text" class="inp-form" /></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Image:</th>
                                    <td><input type="file" class="file_1" /></td>
                                    <td>
                                        <div class="bubble-left"></div>
                                        <div class="bubble-inner">JPEG, GIF 5MB max per image</div>
                                        <div class="bubble-right"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <th valign="top">Description:</th>
                                    <td><textarea rows="" cols="" class="form-textarea"></textarea></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th valign="top">Stock:</th>
                                    <td><input type="text" class="inp-form" /></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>&nbsp;</th>
                                    <td valign="top">
                                        <input type="button" value="" class="form-submit" />
                                        <input type="reset" value="" class="form-reset"  />
                                    </td>
                                    <td></td>
                                </tr>
                            </table>
                            <!-- end id-form  -->

                        </td>

                    </tr>
                    <tr>
                        <td><img src="images/shared/blank.gif" width="695" height="1" alt="blank" /></td>
                        <td></td>
                    </tr>
                </table>

                <div class="clear"></div>


            </div>
            <!--  end content-table-inner  -->
        </td>
        <td id="tbl-border-right"></td>
    </tr>
    <tr>
        <th class="sized bottomleft"></th>
        <td id="tbl-border-bottom">&nbsp;</td>
        <th class="sized bottomright"></th>
    </tr>
</table>

<div class="clear">&nbsp;</div>

</div>
