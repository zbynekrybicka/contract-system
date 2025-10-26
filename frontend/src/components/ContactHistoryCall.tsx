export default function ContactHistoryCall({ call }) {
    return <div>{call.realizedAt} &ndash; {call.purpose} | {call.description} </div>
}