<!DOCTYPE html>
<html>

<body style="font-family:Arial;background:#f3f4f6;padding:40px;">

<table width="650" align="center"
style="background:white;border-radius:12px;">

<tr>

<td style="background:#16a34a;color:white;padding:25px;">

<h1>✅ Ticket Resolved</h1>

</td>

</tr>

<tr>

<td style="padding:35px;">

<h2>

Hello {{ $ticket->creator->name }}

</h2>

<p>

Great news!

</p>

<p>

Our technician has marked your support request as resolved.

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

<span style="color:green;font-weight:bold;">

Resolved

</span>

</td>

</tr>

</table>

<p style="margin-top:25px;">

If everything is working correctly,

you may close the ticket.

</p>

<p>

If the problem still exists,

simply add another comment and our technician will continue assisting you.

</p>

<br>

<a href="{{ route('tickets.show',$ticket) }}"
style="
background:#16a34a;
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