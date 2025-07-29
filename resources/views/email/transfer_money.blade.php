@php
$transaction_id = session()->get('transaction_id');
$sender_id = session()->get('sender_id');
$created_at = session()->get('created_at');
function name($uid)
{
    return DB::table('users')
        ->where('uid', $uid)
        ->select('name')
        ->first()->name;
}
$receiver_id = session()->get('receiver_id');
$transaction_amount = session()->get('transaction_amount');
$transaction_fee = session()->get('transaction_fee');
$subtotal = session()->get('subtotal');

@endphp
<html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"
    xmlns:w="urn:schemas-microsoft-com:office:word" xmlns:m="http://schemas.microsoft.com/office/2004/12/omml"
    xmlns="http://www.w3.org/TR/REC-html40">

<head>
    <meta http-equiv=Content-Type content="text/html; charset=windows-1252">
    <meta name=ProgId content=Word.Document>
    <meta name=Generator content="Microsoft Word 15">
    <meta name=Originator content="Microsoft Word 15">
    <link rel=File-List href="transfe_files/filelist.xml">
    <link rel=Edit-Time-Data href="transfe_files/editdata.mso">

    <style>
        <!--
        /* Font Definitions */
        @font-face {
            font-family: "Cambria Math";
            panose-1: 2 4 5 3 5 4 6 3 2 4;
            mso-font-charset: 0;
            mso-generic-font-family: roman;
            mso-font-pitch: variable;
            mso-font-signature: 3 0 0 0 1 0;
        }

        @font-face {
            font-family: Calibri;
            panose-1: 2 15 5 2 2 2 4 3 2 4;
            mso-font-charset: 0;
            mso-generic-font-family: swiss;
            mso-font-pitch: variable;
            mso-font-signature: -469750017 -1073732485 9 0 511 0;
        }

        @font-face {
            font-family: Roboto;
            panose-1: 2 0 0 0 0 0 0 0 0 0;
            mso-font-charset: 0;
            mso-generic-font-family: auto;
            mso-font-pitch: variable;
            mso-font-signature: -536870145 1342185563 32 0 415 0;
        }

        @font-face {
            font-family: Oswald;
            panose-1: 0 0 0 0 0 0 0 0 0 0;
            mso-font-charset: 0;
            mso-generic-font-family: auto;
            mso-font-pitch: variable;
            mso-font-signature: -1610611969 1073750091 0 0 407 0;
        }

        /* Style Definitions */
        p.MsoNormal,
        li.MsoNormal,
        div.MsoNormal {
            mso-style-unhide: no;
            mso-style-qformat: yes;
            mso-style-parent: "";
            margin-top: 0in;
            margin-right: 0in;
            margin-bottom: 8.0pt;
            margin-left: 0in;
            line-height: 106%;
            mso-pagination: widow-orphan;
            font-size: 11.0pt;
            font-family: "Calibri", sans-serif;
            mso-ascii-font-family: Calibri;
            mso-ascii-theme-font: minor-latin;
            mso-fareast-font-family: Calibri;
            mso-fareast-theme-font: minor-latin;
            mso-hansi-font-family: Calibri;
            mso-hansi-theme-font: minor-latin;
            mso-bidi-font-family: "Times New Roman";
            mso-bidi-theme-font: minor-bidi;
        }

        a:link,
        span.MsoHyperlink {
            mso-style-noshow: yes;
            mso-style-priority: 99;
            color: blue;
            text-decoration: underline;
            text-underline: single;
        }

        a:visited,
        span.MsoHyperlinkFollowed {
            mso-style-noshow: yes;
            mso-style-priority: 99;
            color: purple;
            text-decoration: underline;
            text-underline: single;
        }

        p.msonormal0,
        li.msonormal0,
        div.msonormal0 {
            mso-style-name: msonormal;
            mso-style-unhide: no;
            mso-margin-top-alt: auto;
            margin-right: 0in;
            mso-margin-bottom-alt: auto;
            margin-left: 0in;
            mso-pagination: widow-orphan;
            font-size: 12.0pt;
            font-family: "Times New Roman", serif;
            mso-fareast-font-family: "Times New Roman";
            mso-fareast-theme-font: minor-fareast;
        }

        .MsoChpDefault {
            mso-style-type: export-only;
            mso-default-props: yes;
            font-size: 10.0pt;
            mso-ansi-font-size: 10.0pt;
            mso-bidi-font-size: 10.0pt;
            font-family: "Calibri", sans-serif;
            mso-ascii-font-family: Calibri;
            mso-ascii-theme-font: minor-latin;
            mso-fareast-font-family: Calibri;
            mso-fareast-theme-font: minor-latin;
            mso-hansi-font-family: Calibri;
            mso-hansi-theme-font: minor-latin;
            mso-bidi-font-family: "Times New Roman";
            mso-bidi-theme-font: minor-bidi;
        }

        @page WordSection1 {
            size: 8.5in 11.0in;
            margin: 1.0in 1.0in 1.0in 1.0in;
            mso-header-margin: .5in;
            mso-footer-margin: .5in;
            mso-paper-source: 0;
        }

        div.WordSection1 {
            page: WordSection1;
        }

        -->
    </style>
    <!--[if gte mso 10]>
<style>
 /* Style Definitions */
 table.MsoNormalTable
 {mso-style-name:"Table Normal";
 mso-tstyle-rowband-size:0;
 mso-tstyle-colband-size:0;
 mso-style-noshow:yes;
 mso-style-priority:99;
 mso-style-parent:"";
 mso-padding-alt:0in 5.4pt 0in 5.4pt;
 mso-para-margin:0in;
 mso-pagination:widow-orphan;
 font-size:10.0pt;
 font-family:"Calibri",sans-serif;
 mso-ascii-font-family:Calibri;
 mso-ascii-theme-font:minor-latin;
 mso-hansi-font-family:Calibri;
 mso-hansi-theme-font:minor-latin;
 mso-bidi-font-family:"Times New Roman";
 mso-bidi-theme-font:minor-bidi;}
</style>
<![endif]-->
    <!--[if gte mso 9]><xml>
 <o:shapedefaults v:ext="edit" spidmax="1026"/>
</xml><![endif]-->
    <!--[if gte mso 9]><xml>
 <o:shapelayout v:ext="edit">
  <o:idmap v:ext="edit" data="1"/>
 </o:shapelayout></xml><![endif]-->
</head>


<body lang=EN-US link=blue vlink=purple style='tab-interval:.5in;word-wrap:
break-word'>

    <div class=WordSection1>

        <div align=center>

            <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=640 style='width:480.0pt;border-collapse:collapse;mso-yfti-tbllook:1184;
 mso-padding-alt:0in 0in 0in 0in'>
                <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
                    <td style='padding:0in 0in 0in 0in'>
                        <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width="100%" style='width:100.0%;border-collapse:collapse;mso-yfti-tbllook:1184;
   mso-padding-alt:0in 0in 0in 0in'>
                            <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
                                <td style='padding:3.75pt 3.75pt 3.75pt 3.75pt'>
                                    <p class=MsoNormal align=right style='margin-bottom:0in;text-align:right;
    line-height:11.25pt'><span style='font-size:8.5pt;font-family:"Arial",sans-serif;
    mso-fareast-font-family:"Times New Roman";color:#485161'><a
                                                href="http://smtp2.info.skrill.com/track?t=v&amp;enid=ZWFzPTEmbXNpZD0xJmF1aWQ9MTI3NTc4OSZtaWQ9MjQ2ODI1Jm1zZ2lkPTEwNDAwJmRpZD0xNjA0NjU1MjA5JmVkaWQ9MTYwNDY1NTIwOSZzbj0xNjc4MDU0NyZlaWQ9c2hhaHJpYS5mYW5jeTE5OTNAZ21haWwuY29tJmVlaWQ9c2hhaHJpYS5mYW5jeTE5OTNAZ21haWwuY29tJnVpZD0xXzM1MzA5JnRhcmdldGlkPSZtbj05Mzc1NTQ1JnJpZD0zNTMwOSZlcmlkPTM1MzA5JmZsPSZtdmlkPSZ0Z2lkPSZleHRyYT0=&amp;&amp;&amp;246825&amp;eu=1&amp;&amp;&amp;"
                                                target="_blank"><span style='color:#485161'>View In Browser</span></a>

                                        </span></p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr style='mso-yfti-irow:1'>
                    <td style='background:#222222;padding:0in 0in 0in 0in'>
                        <div align=center>
                            <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width="100%" style='width:100.0%;border-collapse:collapse;mso-yfti-tbllook:1184;
   mso-padding-alt:0in 0in 0in 0in'>
                                <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
                                    <td width=124 valign=top style='width:93.0pt;padding:0in 0in 0in 0in'>
                                        <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><a
                                                href="https://www.skrill.com/en/?utm_source=strongview&amp;utm_medium=email&amp;utm_campaign=246825"
                                                target="_blank"><span style='font-size:12.0pt;font-family:Roboto;
    mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:"Times New Roman";
    color:#1155CC;mso-no-proof:yes;text-decoration:none;text-underline:none'>
                                                    <!--[if gte vml 1]><v:shapetype
     id="_x0000_t75" coordsize="21600,21600" o:spt="75" o:preferrelative="t"
     path="m@4@5l@4@11@9@11@9@5xe" filled="f" stroked="f">
     <v:stroke joinstyle="miter"/>
     <v:formulas>
      <v:f eqn="if lineDrawn pixelLineWidth 0"/>
      <v:f eqn="sum @0 1 0"/>
      <v:f eqn="sum 0 0 @1"/>
      <v:f eqn="prod @2 1 2"/>
      <v:f eqn="prod @3 21600 pixelWidth"/>
      <v:f eqn="prod @3 21600 pixelHeight"/>
      <v:f eqn="sum @0 0 1"/>
      <v:f eqn="prod @6 1 2"/>
      <v:f eqn="prod @7 21600 pixelWidth"/>
      <v:f eqn="sum @8 21600 0"/>
      <v:f eqn="prod @7 21600 pixelHeight"/>
      <v:f eqn="sum @10 21600 0"/>
     </v:formulas>
     <v:path o:extrusionok="f" gradientshapeok="t" o:connecttype="rect"/>
     <o:lock v:ext="edit" aspectratio="t"/>
    </v:shapetype><v:shape id="Picture_x0020_6" o:spid="_x0000_i1028" type="#_x0000_t75"
     href="https://www.skrill.com/en/?utm_source=strongview&amp;utm_medium=email&amp;utm_campaign=246825"
     target="&quot;_blank&quot;" style='width:90.75pt;height:37.5pt;
     visibility:visible;mso-wrap-style:square' o:button="t">
     <v:fill o:detectmouseclick="t"/>
     <v:imagedata src="transfe_files/image001.png" o:title="" cropbottom="-88f"/>
    </v:shape><![endif]-->
                                                    <![if !vml]>
                                                    <span style='mso-ignore:vglayout'>
                                                        <img src="{{ asset('assets/img/logo.png') }}" border=0
                                                            width=121 height=50 v:shapes="Picture_x0020_6">
                                                    </span>
                                                    <![endif]>
                                                </span></a><span style='font-size:12.0pt;font-family:Roboto;mso-fareast-font-family:"Times New Roman";
    mso-bidi-font-family:"Times New Roman"'>

                                            </span></p>
                                    </td>
                                    <td style='padding:0in 0in 0in 0in'>
                                        <div align=center>
                                            <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0
                                                width="100%" style='width:100.0%;border-collapse:collapse;mso-yfti-tbllook:
     1184;mso-padding-alt:0in 0in 0in 0in'>
                                                <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
                                                    <td style='padding:0in 0in 0in 0in'></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                    <td width=30 style='width:22.5pt;padding:0in 0in 0in 0in'>
                                        <p class=MsoNormal style='margin-bottom:0in;mso-line-height-alt:.75pt'><span
                                                style='font-size:1.0pt;font-family:Roboto;mso-fareast-font-family:"Times New Roman";
    mso-bidi-font-family:"Times New Roman"'>&nbsp;</span></p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr style='mso-yfti-irow:2'>
                    <td style='padding:0in 0in 0in 0in'></td>
                </tr>
                <tr style='mso-yfti-irow:3'>
                    <td style='background:#5C235A;padding:0in 0in 0in 0in'>
                        <div align=center>
                            <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width="100%" style='width:100.0%;border-collapse:collapse;mso-yfti-tbllook:1184;
   mso-padding-alt:0in 0in 0in 0in'>
                                <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
                                    <td width=35 style='width:26.25pt;padding:0in 0in 0in 0in'>
                                        <p class=MsoNormal style='margin-bottom:0in;mso-line-height-alt:.75pt'><span
                                                style='font-size:1.0pt;font-family:Roboto;mso-fareast-font-family:"Times New Roman";
    mso-bidi-font-family:"Times New Roman"'>&nbsp;</span></p>
                                    </td>
                                    <td valign=top style='padding:0in 0in 0in 0in'>
                                        <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width="100%"
                                            style='width:100.0%;border-collapse:collapse;mso-yfti-tbllook:
     1184;mso-padding-alt:0in 0in 0in 0in'>
                                            <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:33.75pt'>
                                                <td style='padding:0in 0in 0in 0in;height:33.75pt'>
                                                    <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>
                                                        <span style='font-size:12.0pt;font-family:Roboto;mso-fareast-font-family:"Times New Roman";
      mso-bidi-font-family:"Times New Roman"'>&nbsp;</span>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr style='mso-yfti-irow:1'>
                                                <td valign=top style='padding:0in 0in 0in 0in'>
                                                    <p class=MsoNormal style='margin-bottom:0in;line-height:18.75pt'>
                                                        <span style='font-size:13.5pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
      "Times New Roman";color:white'>Hi {{ name($sender_id) }},</span>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr style='mso-yfti-irow:2;height:15.0pt'>
                                                <td width=1 style='width:.75pt;padding:0in 0in 0in 0in;height:15.0pt'>
                                                    <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>
                                                        <span style='font-size:12.0pt;font-family:Roboto;mso-fareast-font-family:"Times New Roman";
      mso-bidi-font-family:"Times New Roman"'>&nbsp;</span>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr style='mso-yfti-irow:3'>
                                                <td valign=top style='padding:0in 0in 0in 0in'>
                                                    <p class=MsoNormal style='margin-bottom:0in;line-height:40.5pt'>
                                                        <b><span style='font-size:31.0pt;font-family:Oswald;mso-fareast-font-family:"Times New Roman";
      mso-bidi-font-family:"Times New Roman";color:white'>YOU JUST SENT </span></b><span style='font-size:31.0pt;font-family:Oswald;mso-fareast-font-family:"Times New Roman";
      mso-bidi-font-family:"Times New Roman";color:white'>

                                                        </span>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr style='mso-yfti-irow:4;height:15.0pt'>
                                                <td width=1 style='width:.75pt;padding:0in 0in 0in 0in;height:15.0pt'>
                                                    <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>
                                                        <span style='font-size:12.0pt;font-family:Roboto;mso-fareast-font-family:"Times New Roman";
      mso-bidi-font-family:"Times New Roman"'>&nbsp;</span>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr style='mso-yfti-irow:5'>
                                                <td valign=top style='padding:0in 0in 0in 0in'>
                                                    <p class=MsoNormal style='margin-bottom:0in;line-height:18.75pt'>
                                                        <span style='font-size:15.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
                                                        "Times New Roman";color:white'>USD
                                                            {{ number_format($transaction_amount, 2) }} to
                                                            {{ name($receiver_id) }}.
                                                        </span>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr style='mso-yfti-irow:8;mso-yfti-lastrow:yes;height:15.0pt'>
                                                <td width=1 style='width:.75pt;padding:0in 0in 0in 0in;height:15.0pt'>
                                                    <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>
                                                        <span style='font-size:12.0pt;font-family:Roboto;mso-fareast-font-family:"Times New Roman";
                                                         mso-bidi-font-family:"Times New Roman"'>&nbsp;
                                                        </span>
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td width=100 style='width:75.0pt;padding:0in 0in 0in 0in'>
                                        <p class=MsoNormal style='margin-bottom:0in;mso-line-height-alt:.75pt'><span
                                                style='font-size:1.0pt;font-family:Roboto;mso-fareast-font-family:"Times New Roman";
                                                mso-bidi-font-family:"Times New Roman"'>&nbsp;</span></p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr style='mso-yfti-irow:4'>
                    <td style='padding:0in 0in 0in 0in'>
                        <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width="100%" style='width:100.0%;background:white;border-collapse:collapse;mso-yfti-tbllook:
                                            1184;mso-padding-alt:0in 0in 0in 0in'>
                            <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
                                <td style='padding:0in 22.5pt 0in 22.5pt'>
                                    <div align=center>
                                        <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=580
                                            style='width:435.0pt;border-collapse:collapse;mso-yfti-tbllook:1184;
                                                 mso-padding-alt:0in 0in 0in 0in'>
                                            <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:7.5pt'>
                                                <td style='padding:0in 0in 0in 0in;height:7.5pt'>
                                                    <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>
                                                        <span style='font-size:12.0pt;font-family:Roboto;mso-fareast-font-family:"Times New Roman";
                                                             mso-bidi-font-family:"Times New Roman"'>&nbsp;
                                                        </span>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr style='mso-yfti-irow:1'>
                                                <td style='padding:0in 0in 0in 0in'>
                                                    <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0
                                                        width=580 style='width:435.0pt;border-collapse:collapse;mso-yfti-tbllook:
                                                            1184;mso-padding-alt:7.5pt 7.5pt 7.5pt 7.5pt'>
                                                        <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
                                                            <td width=250 style='width:187.5pt;border:none;border-bottom:solid #865474 1.5pt;
                                                             padding:7.5pt 7.5pt 7.5pt 7.5pt'>
                                                                <p class=MsoNormal
                                                                    style='margin-bottom:0in;line-height:normal'><span
                                                                        style='font-size:12.0pt;font-family:"Times New Roman",serif;mso-fareast-font-family:
        "Times New Roman";color:#865474'>Money sent to:</span></p>
                                                            </td>
                                                            <td
                                                                style='border:none;border-bottom:solid #865474 1.5pt;padding:7.5pt 7.5pt 7.5pt 7.5pt'>
                                                                <p class=MsoNormal
                                                                    style='margin-bottom:0in;line-height:normal'>
                                                                    <b><span style='font-size:12.0pt;font-family:"Times New Roman",serif;mso-fareast-font-family:
        "Times New Roman";color:#865474'>{{ name($receiver_id) }}</span></b>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr style='mso-yfti-irow:2'>
                                                            <td
                                                                style='border:none;border-bottom:solid #865474 1.5pt;padding:7.5pt 7.5pt 7.5pt 7.5pt'>
                                                                <p class=MsoNormal
                                                                    style='margin-bottom:0in;line-height:normal'><span
                                                                        style='font-size:12.0pt;font-family:"Times New Roman",serif;mso-fareast-font-family:
        "Times New Roman";color:#865474'>Date and time:</span></p>
                                                            </td>
                                                            <td
                                                                style='border:none;border-bottom:solid #865474 1.5pt;padding:7.5pt 7.5pt 7.5pt 7.5pt'>
                                                                <p class=MsoNormal
                                                                    style='margin-bottom:0in;line-height:normal'>
                                                                    <b><span style='font-size:12.0pt;font-family:"Times New Roman",serif;mso-fareast-font-family:
        "Times New Roman";color:#865474'>{{ $created_at->format('H:m , d m Y') }}</span></b>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr style='mso-yfti-irow:3;mso-yfti-lastrow:yes'>
                                                            <td
                                                                style='border:none;border-bottom:solid #865474 1.5pt;padding:7.5pt 7.5pt 7.5pt 7.5pt'>
                                                                <p class=MsoNormal
                                                                    style='margin-bottom:0in;line-height:normal'><span
                                                                        style='font-size:12.0pt;font-family:"Times New Roman",serif;mso-fareast-font-family:
                                                                        "Times New Roman";color:#865474'>Transaction
                                                                        ID:</span></p>
                                                            </td>
                                                            <td
                                                                style='border:none;border-bottom:solid #865474 1.5pt;padding:7.5pt 7.5pt 7.5pt 7.5pt'>
                                                                <p class=MsoNormal
                                                                    style='margin-bottom:0in;line-height:normal'>
                                                                    <b><span style='font-size:12.0pt;font-family:"Times New Roman",serif;mso-fareast-font-family:
                                                                    "Times New Roman";color:#865474'>{{ $transaction_id }}

                                                                        </span></b>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr style='mso-yfti-irow:2;mso-yfti-lastrow:yes;height:7.5pt'>
                                                <td style='padding:0in 0in 0in 0in;height:7.5pt'>
                                                    <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>
                                                        <span style='font-size:12.0pt;font-family:Roboto;mso-fareast-font-family:"Times New Roman";
                                                            mso-bidi-font-family:"Times New Roman"'>&nbsp;
                                                        </span>
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr style='mso-yfti-irow:5'>
                    <td style='background:white;padding:0in 0in 0in 0in'>
                        <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width="100%" style='width:100.0%;border-collapse:collapse;mso-yfti-tbllook:1184;
   mso-padding-alt:0in 0in 0in 0in'>
                            <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
                                <td style='padding:15.0pt 22.5pt 15.0pt 22.5pt'>
                                    <p class=MsoNormal style='margin-bottom:0in;line-height:15.0pt'><span style='font-size:11.5pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
    "Times New Roman";color:#865474'>If you didn't do this, or do not recognize
                                            any of the above details, please contact us right away.</span>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr style='mso-yfti-irow:6'>
                    <td style='background:white;padding:0in 0in 0in 0in'>
                        <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width="100%" style='width:100.0%;border-collapse:collapse;mso-yfti-tbllook:1184;
   mso-padding-alt:0in 0in 0in 0in'>
                            <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
                                <td style='padding:15.0pt 22.5pt 15.0pt 22.5pt'>
                                    <p class=MsoNormal style='margin-bottom:0in;line-height:15.0pt'><b><span style='font-size:11.5pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
    "Times New Roman";color:#865474'>Thank you for choosing&nbsp;<span style="color:#fd961a;">(OTT)</span></span></b><span style='font-size:11.5pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
    "Times New Roman";color:#865474'>

                                        </span></p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr style='mso-yfti-irow:7'>
                    <td style='background:white;padding:0in 0in 0in 0in'>
                        <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width="100%" style='width:100.0%;border-collapse:collapse;mso-yfti-tbllook:1184;
   mso-padding-alt:0in 0in 0in 0in'>
                            <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
                                <td style='padding:15.0pt 22.5pt 15.0pt 22.5pt'>
                                    <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
    "Times New Roman";color:#555555;mso-no-proof:yes'>
                                            <!--[if gte vml 1]><v:shape
     id="Picture_x0020_10" o:spid="_x0000_i1025" type="#_x0000_t75" style='width:90.75pt;
     height:21pt;visibility:visible;mso-wrap-style:square'>
     <v:imagedata src="transfe_files/image005.png" o:title=""/>
    </v:shape><![endif]-->

                                        </span><span style='font-size:12.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
    "Times New Roman";color:#555555'>

                                        </span></p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr style='mso-yfti-irow:8;mso-yfti-lastrow:yes;height:75.0pt'>
                    <td style='background:#822065;padding:0in 0in 0in 0in;height:75.0pt'>
                        <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
  line-height:normal'><span style='font-size:12.0pt;font-family:Roboto;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:white;mso-themecolor:background1'>See you transfer records on your
                                dashboard</span><span style='font-size:12.0pt;font-family:Roboto;mso-fareast-font-family:
  "Times New Roman";mso-bidi-font-family:Arial;color:#222222'>

                            </span></p>
                    </td>
                </tr>
            </table>

        </div>

        <p class=MsoNormal>
            <o:p>&nbsp;</o:p>
        </p>

    </div>

</body>

</html>
