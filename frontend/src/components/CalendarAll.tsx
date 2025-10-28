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
    const meetingFilter: (meeting: Meeting) => boolean = (meeting) => {
        const appointment = DateTime.fromISO(meeting.appointment)
        return appointment >= start && appointment <= end
    }


    /**
     * Meeting cell
     * 
     * @param meeting Meeting
     * @returns JSX.Element
     */
    const meetingCell: (meeting: Meeting) => JSX.Element =  (meeting) => {
        
        /**
         * Meeting appointment
         * Meeting ID
         * readable appointment
         */
        const appointment = DateTime.fromISO(meeting.appointment)
        const meetingId: number = meeting.id
        const readableAppointment: string = appointment.toFormat('dd.MM HH:mm')


        /**
         * 
         * @param participant Contact
         * @returns JSX.Element
         */
        const participantElement: (participant: Contact) => JSX.Element = (participant) => {

            /**
             * Participant ID
             * Last name
             */
            const participantId: number = participant.id
            const lastName = participant.lastName

            return <div key={participantId}>{lastName}</div>
        }

        return <div className="calendar-event meeting" key={meetingId} data-meeting-id={meetingId}>
            {readableAppointment}
            {meeting.participants.map(participantElement)}
        </div>
    }

    return <div>

        {/**
          * Interval selection control 
          */}
        <div className="row">
            <input type="date" defaultValue={startDefaultValue} onChange={handleSelectStart} />
            <input type="date" defaultValue={endDefaultValue} onChange={handleSelectEnd} />
        </div>


        {/**
          * List of meetings
          */}
        <div className="calendar-all">
            {meetingList.filter(meetingFilter).map(meetingCell)}            
        </div>
    </div>
}