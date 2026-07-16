<!DOCTYPE html>
<html>

<body style="font-family:Arial;background:#f4f6f9;padding:40px;">

<table width="650" align="center"
style="background:white;border-radius:12px;">

<tr>

<td style="background:#0ea5e9;color:white;padding:25px;">

<h2>TambuaDesk</h2>

<p>A new comment has been added.</p>

</td>

</tr>

<tr>

<td style="padding:35px;">

<h2>

New Comment

</h2>

<p>

<strong>{{ $comment->user->name }}</strong>

commented on ticket

<strong>{{ $comment->ticket->ticket_number }}</strong>

</p>

<div style="background:#f3f4f6;padding:20px;border-radius:8px;margin:25px 0;">

{{ $comment->comment }}

</div>

<a href="{{ route('tickets.show',$comment->ticket) }}"
style="background:#2563eb;
color:white;
padding:12px 20px;
text-decoration:none;
border-radius:8px;">

View Ticket

</a>

</td>

</tr>

</table>

</body>

</html>