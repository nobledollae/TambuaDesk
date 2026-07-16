<!DOCTYPE html>
<html>

<body style="font-family:Arial;background:#f3f4f6;padding:40px;">

<table width="650" align="center"
style="background:white;border-radius:12px;">

<tr>

<td style="background:#374151;color:white;padding:25px;">

<h1>🔒 Ticket Closed</h1>

</td>

</tr>

<tr>

<td style="padding:35px;">

<h2>

Hello {{ $ticket->creator->name }}

</h2>

<p>

Your support request has now been closed.

</p>

<table width="100%" cellpadding="12">

<tr>

<td width="35%"><strong>Ticket Number</strong></td>

<td>{{ $ticket->ticket_number }}</td>

</tr>

<tr>

<td><strong>Title</strong></td>

<td>{{ $ticket->title }}</td>

</tr>

<tr>

<td><strong>Status</strong></td>

<td>

<strong style="color:#374151">

Closed

</strong>

</td>

</tr>

</table>

<p style="margin-top:25px;">

Thank you for using TambuaDesk.

</p>

<p>

If this issue happens again,

please create a new ticket and we'll be happy to assist you.

</p>

<br>

<a href="{{ route('tickets.show',$ticket) }}"
style="
background:#374151;
color:white;
padding:14px 22px;
text-decoration:none;
border-radius:8px;">

View Ticket

</a>

</td>

</tr>

</table>

</body>

</html>