
<table width="570" border="2" align="center" cellpadding="0" cellspacing="0">
    @include('contact::public.emails.partial.header')
    <tr>
        <td valign="top" class="content" bgcolor="#CEF">
     		<table width="100%" border="0" cellspacing="0" cellpadding="" style="margin-bottom: 30px;">
              <td width="80%" style="padding-top: 20px;">
               <span style="color: #270188; font-size: 12px; font-weight:bold;">For more information, contact:</span><br /><br />
               <span style="color: #270188; font-size: 12px; font-weight:bold;">Name:         {!!@$name!!}</span><br />
               <span style="color: #270188; font-size: 12px; font-weight:bold;">Email Id:     {!!@$email!!}</span><br />
               <span style="color: #270188; font-size: 12px; font-weight:bold;">Message:      {!!@$subject!!}</span><br />
              </td>
          </table>
          <table width="570" border="0" cellspacing="0" style="">
              <td style="">

              </td>
                 <br />
                 <br />
                 <br />
             </td>
          </table>

        </td>
    </tr>
   @include('contact::public.emails.partial.footer')
</table>
