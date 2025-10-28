import type { JSX } from "react"
import type { Call } from "../services/api/callApi"

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
    const realizedAt: string = call.realizedAt
    const purpose: string = call.purpose
    const description: string = call.description

    return <div>{realizedAt} &ndash; {purpose} | {description} </div>
}