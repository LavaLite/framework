
<table width="570" border="2" align="center" cellpadding="0" cellspacing="0">
    @include('contacts::public.emails.partial.serviceHeader')
    <tr>
        <td valign="top" class="content" bgcolor="#CEF">
     		<table width="100%" border="0" cellspacing="0" cellpadding="" style="margin-bottom: 30px;">
              <td width="80%" style="padding-top: 20px;">
               <span style="color: #270188; font-size: 12px; font-weight:bold;">For more information, contact:</span><br /><br />
               <span style="color: #270188; font-size: 12px; font-weight:bold;">Name:         {!!@$name!!}</span><br />
               <span style="color: #270188; font-size: 12px; font-weight:bold;">Email Id:     {!!@$email!!}</span><br />
               <span style="color: #270188; font-size: 12px; font-weight:bold;">Contact No:   {!!@$mobile!!}</span><br />
               <span style="color: #270188; font-size: 12px; font-weight:bold;">Message:      {!!@$messages!!}</span><br />
              <span style="color: #270188; font-size: 12px; font-weight:bold;">Subject:       {!!@$subject!!}</span><br />
              </td>
          </table>
          <table width="100%" border="0" cellspacing="0" style="">
              <td style="">
                   
              </td>
                 <br />
                 <br />
                 <br />
             </td>
          </table>

        </td>
    </tr>
   @include('contacts::public.emails.partial.footer')
</table>