@component('mail::message')
# DATA BACKUP

Hello, {{env('APP_NAME')}}

DAILY DATA BACKUP FROM SUBOFFICE CREATED ON {{date('D d M, Y',strtotime(now()))}} at {{date('h:i A',strtotime(now()))}}

@endcomponent
