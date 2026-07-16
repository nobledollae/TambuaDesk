<!DOCTYPE html>
<html>

<body style="font-family:Arial;background:#f5f7fa;padding:40px;">

<table width="650" align="center"
style="background:white;border-radius:12px;">

<tr>

<td style="background:#f59e0b;color:white;padding:25px;">

<h2>Ticket Status Updated</h2>

</td>

</tr>

<tr>

<td style="padding:35px;">

<p>

Hello {{ $ticket->creator->name }},

</p>

<p>

The status of your ticket has changed.

</p>

<table width="100%" cellpadding="12">

<tr>

<td width="35%"><strong>Ticket</strong></td>

<td>{{ $ticket->ticket_number }}</td>

</tr>

<tr>

<td><strong>Title</strong></td>

<td>{{ $ticket->title }}</td>

</tr>

<tr>

<td><strong>Previous Status</strong></td>

<td>{{ $oldStatus }}</td>

</tr>

<tr>

<td><strong>New Status</strong></td>

<td>

<strong style="color:#2563eb">

{{ $newStatus }}

</strong>

</td>

</tr>

</table>

<br>

<a href="{{ route('tickets.show',$ticket) }}"
style="
background:#2563eb;
padding:12px 20px;
color:white;
text-decoration:none;
border-radius:8px;">

View Ticket

</a>

</td>

</tr>

</table>

</body>

</html>