import type { JSX } from "react";
import type { Meeting } from "../services/api/meetingApi"

type Props = {
    meeting: Meeting;
}

export default function ContactHistoryMeeting({ meeting }: Props): JSX.Element
{
    /**
     * Meeting appointment
     * Place of meeting
     */
    const appointment: string = meeting.appointment
    const place: string = meeting.place

    return <div>
        <div>{appointment} &ndash; {place}</div>
    </div>
}