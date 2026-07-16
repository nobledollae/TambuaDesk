<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
</head>

<body style="font-family:Arial;background:#f5f7fa;padding:40px;">

<table width="650" align="center"
style="background:white;border-radius:12px;overflow:hidden;">

<tr>

<td style="background:#2563eb;color:white;padding:25px;">

<h1>TambuaDesk</h1>

<p>A new ticket has been assigned to you.</p>

</td>

</tr>

<tr>

<td style="padding:35px;">

<h2>Hello {{ $ticket->technician->name }},</h2>

<p>

A new support ticket has been assigned to you.

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

<td><strong>Priority</strong></td>

<td>{{ $ticket->priority }}</td>

</tr>

<tr>

<td><strong>Status</strong></td>

<td>{{ $ticket->status }}</td>

</tr>

<tr>

<td><strong>Description</strong></td>

<td>{{ $ticket->description }}</td>

</tr>

</table>

<br>

<a href="{{ route('tickets.show',$ticket) }}"
style="
background:#2563eb;
padding:14px 24px;
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