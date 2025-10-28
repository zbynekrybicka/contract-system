import { DateTime } from "luxon"
import { useEffect, useState, type ChangeEvent, type JSX } from "react"
import type { Meeting } from "../services/api/meetingApi"
import { distributeAppointments } from "../helpers/distributeAppointments"
import type { Contact } from "../services/api/contactApi"

type Props = {
    meetingList: Meeting[]
}

export default function CalendarDay({ meetingList }: Props): JSX.Element
{
    /**
     * Selected day in calendar
     * Default day in form
     * Handler day
     */
    const [ day, setDay ] = useState<DateTime>(DateTime.now().startOf("day"))
    const dayDefaultValue: string | undefined = day.toISODate() || undefined
    const handleSelectDay: (event: ChangeEvent<HTMLInputElement>) => void = e => setDay(DateTime.fromISO(e.target.value).startOf("day"))


    /**
     * When day is changed or window resized
     */
    distributeAppointments(meetingList, useEffect, [day])


    /**
     * 
     * @param meeting Meeting
     * @returns boolean
     */
    const meetingFilter: (meeting: Meeting) => boolean = (meeting) => {
        /**
         * meeting appointment
         */
        const appointment = DateTime.fromISO(meeting.appointment).toISODate()

        return appointment === day.toISODate()
    }


    const meetingCell: (meeting: Meeting) => JSX.Element = (meeting) => {

        /**
         * Meeting appointment
         * Meeting ID
         * Readable appointment
         */
        const appointment = DateTime.fromISO(meeting.appointment)
        const meetingId = meeting.id
        const readableAppointment = appointment.toFormat('dd.MM HH:mm')


        /**
         * Participant element
         */
        const participantElement: (participant: Contact) => JSX.Element = (participant) => {
            /**
             * Participant ID
             * Participant last name
             */
            const participantId = participant.id
            const lastName = participant.lastName

            return <div key={participantId}>{lastName}</div>
        }

        return <div className="calendar-event meeting" key={meetingId} data-meeting-id={meetingId}>
            {readableAppointment}
            {meeting.participants.map(participantElement)}
        </div>
    }


    /**
     * 
     * @param _null undefined
     * @param hour number
     * @returns JSX.Element
     */
    const hourCell: (_null: any, hour: number) => JSX.Element = (_null, hour) => {

        /**
         * Invisible quarter row
         * 
         * @param minutes number
         * @returns JSX.Element
         */
        const minutesRow: (minutes: number) => JSX.Element = (minutes: number) => {

            /**
             * Calendar time
             * timestamp for attach event
             * key
             */
            const calendarTime = day.plus({ hours: hour, minutes })
            const timestamp: string = calendarTime.toFormat("HH:mm")
            const key = hour * 60 + minutes

            return <div key={key} className="calendar-interval" data-timestamp={timestamp}>&nbsp;</div>
        }

        return <div key={hour} className="calendar-hour">{[0, 15, 30, 45].map(minutesRow)}</div>
    }

    return <div>
        <div className="row">
            <input type="date" defaultValue={dayDefaultValue} onChange={handleSelectDay} />
        </div>
        <div className="calendar-day">{new Array(24).fill(null).map(hourCell)}</div>
        {meetingList.filter(meetingFilter).map(meetingCell)}
    </div>
}