import type { JSX } from "react";
import type { Meeting } from "../services/api/meetingApi"
import { DateTime } from "luxon";

type Props = {
    meeting: Meeting;
}

export default function ContactHistoryMeeting({ meeting }: Props): JSX.Element
{
    /**
     * Meeting appointment
     * Place of meeting
     */
    const appointment: string = DateTime.fromISO(meeting.appointment).toFormat("dd.MM.yyyy HH:mm")
    const place: string = meeting.place

    return <>
        <div className="table-label">Meeting:</div>
        <div>{appointment}</div>
        <div>{place}</div>
    </>
}