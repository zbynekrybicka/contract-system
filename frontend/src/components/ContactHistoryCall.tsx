import type { JSX } from "react"
import type { Call } from "../services/api/callApi"
import { DateTime } from "luxon"

type Props = {
    call: Call
}

export default function ContactHistoryCall({ call }: Props): JSX.Element
{
    /**
     * Call Realized At
     * Purpose of Call
     * Description of Call Result
     */
    const realizedAt: string = DateTime.fromISO(call.realizedAt).toFormat("dd.MM.yyyy HH:mm")
    const purpose: string = call.purpose
    const description: string = call.description

    return <>
        <div className="table-label">Call: </div>
        <div>{realizedAt}</div> 
        <div>{purpose} | {description}</div>
    </>
}