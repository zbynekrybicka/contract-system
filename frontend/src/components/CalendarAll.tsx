import { DateTime } from "luxon"
import { useState, type ChangeEvent, type JSX } from "react"
import type { Meeting } from "../services/api/meetingApi"
import type { Contact } from "../services/api/contactApi"

type Props = {
    meetingList: Meeting[]
}

export default function CalendarAll({ meetingList }: Props)
{

    /** 
     * Appointment from 
     * and to
     */
    const [ start, setStart ] = useState<DateTime>(DateTime.now().startOf("day"))
    const [ end, setEnd ] = useState<DateTime>(DateTime.now().endOf("day"))


    /**
     * Default start in form
     * Default end in form
     * Handler start
     * Handler end
     */
    const startDefaultValue: string | undefined = start.toISODate() || undefined
    const endDefaultValue: string | undefined = end.toISODate() || undefined
    const handleSelectStart: (event: ChangeEvent<HTMLInputElement>) => void = e => setStart(DateTime.fromISO(e.target.value).startOf("day"))
    const handleSelectEnd: (event: ChangeEvent<HTMLInputElement>) => void = e => setEnd(DateTime.fromISO(e.target.value).endOf("day"))    


    /**
     * Meeting filter
     * 
     * @param meeting Meeting
     * @returns boolean
     */
    function meetingFilter(meeting: Meeting): boolean
    {
        const appointment = DateTime.fromISO(meeting.appointment)
        return appointment >= start && appointment <= end
    }


    /**
     * 
     * @param participant Contact
     * @returns JSX.Element
     */
    function participantElement(participant: Contact): JSX.Element
    {

        /**
         * Participant ID
         * Last name
         */
        const participantId: number = participant.id
        const lastName = participant.lastName

        return <div key={participantId}>{lastName}</div>
    }


    /**
     * Meeting cell
     * 
     * @param meeting Meeting
     * @returns JSX.Element
     */
    function meetingCell(meeting: Meeting): JSX.Element
    {   

        /**
         * Meeting appointment
         * Meeting ID
         * readable appointment
         */
        const appointment = DateTime.fromISO(meeting.appointment)
        const meetingId: number = meeting.id
        const readableAppointment: string = appointment.toFormat('dd.MM HH:mm')


        return <div className="row" key={meetingId} data-meeting-id={meetingId}>
            <div>{readableAppointment}</div>
            <div>{meeting.participants.map(participantElement)}</div>
        </div>
    }


    return <div>
        <div className="white-box">
            <input type="date" defaultValue={startDefaultValue} onChange={handleSelectStart} />
            <input type="date" defaultValue={endDefaultValue} onChange={handleSelectEnd} />
        </div>
        <div className="calendar-all white-box">
            <h3>All events</h3>
            <div className="table">
                <div className="row header">
                    <div>Appointment</div>
                    <div>Participants</div>
                </div>
                {meetingList.filter(meetingFilter).map(meetingCell)}
            </div>
        </div>
    </div>
}