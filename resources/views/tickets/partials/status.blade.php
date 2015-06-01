<span {!! Html::classes(['label label-info absolute', 'highlight' => $ticket->open]) !!}>
    {{ trans('ticket.'.$ticket->status) }}
</span>