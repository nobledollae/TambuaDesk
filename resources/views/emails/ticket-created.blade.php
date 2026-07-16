<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Ticket Created</title>
</head>

<body style="font-family:Arial,sans-serif;background:#f3f4f6;padding:40px;">

<table width="650" align="center"
       style="background:white;border-radius:10px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,.08);">

    <tr>

        <td style="background:#2563eb;color:white;padding:25px;">

            <h1 style="margin:0;">
                TambuaDesk
            </h1>

            <p style="margin-top:8px;">
                IT Support Ticketing System
            </p>

        </td>

    </tr>

    <tr>

        <td style="padding:35px;">

            <h2>

                Hello {{ $ticket->creator->name }},

            </h2>

            <p>

                Your support request has been received successfully.

            </p>

            <table width="100%" cellpadding="12"
                   style="margin-top:25px;border-collapse:collapse;">

                <tr style="background:#f9fafb;">

                    <td width="35%">
                        <strong>Ticket Number</strong>
                    </td>

                    <td>

                        {{ $ticket->ticket_number }}

                    </td>

                </tr>

                <tr>

                    <td>

                        <strong>Title</strong>

                    </td>

                    <td>

                        {{ $ticket->title }}

                    </td>

                </tr>

                <tr style="background:#f9fafb;">

                    <td>

                        <strong>Priority</strong>

                    </td>

                    <td>

                        {{ $ticket->priority }}

                    </td>

                </tr>

                <tr>

                    <td>

                        <strong>Status</strong>

                    </td>

                    <td>

                        {{ $ticket->status }}

                    </td>

                </tr>

                <tr style="background:#f9fafb;">

                    <td>

                        <strong>Created</strong>

                    </td>

                    <td>

                        {{ $ticket->created_at->format('d M Y H:i') }}

                    </td>

                </tr>

            </table>

            <div style="margin-top:35px;">

                <a href="{{ route('tickets.show',$ticket) }}"
                   style="background:#2563eb;
                          color:white;
                          text-decoration:none;
                          padding:14px 25px;
                          border-radius:8px;">

                    View Ticket

                </a>

            </div>

            <hr style="margin:40px 0;">

            <small style="color:#666;">

                This is an automated email from TambuaDesk.

            </small>

        </td>

    </tr>

</table>

</body>

</html>