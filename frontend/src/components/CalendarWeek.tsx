import { useEffect, useState, type JSX } from "react"
import { DateTime } from "luxon"
import type { Meeting } from "../services/api/meetingApi"
import { distributeAppointments } from "../helpers/distributeAppointments"
import type { Contact } from "../services/api/contactApi"

type Props = {
    meetingList: Meeting[]
}

export default function CalendarWeek({ meetingList }: Props): JSX.Element
{
    /**
     * Selected week
     * Begin of selected interval
     * End of selected interval
     * Readable start
     * Readable end
     * Timestamp Format
     * Handle previous week
     * Handle next week
     * Handle current week
     */
    const [ week, setWeek ] = useState(0)
    const mondayStart = DateTime.now().plus({ weeks: week }).startOf("week")
    const sundayEnd = mondayStart.endOf("week")
    const readableMondayStart: string = mondayStart.toFormat("dd. MM.")
    const readableSundayEnd: string = sundayEnd.toFormat("dd. MM. yyyy")
    const timestampFormat: string = "yyyy-MM-dd-HH-mm"
    const handlePrevWeek: () => void = () => setWeek(week - 1)
    const handleNextWeek: () => void = () => setWeek(week + 1)
    const handleCurrentWeek: () => void = () => setWeek(0)

    /**
     * When day is changed or window resized
     */
    distributeAppointments(meetingList, useEffect, [week], timestampFormat)


    /**
     * 
     * @param _null null
     * @param index number
     * @returns JSX.Element
     */
    const dayColumn: (_null: null, index: number) => JSX.Element = (_null, index) => {

        /**
         * 
         * @param _null null
         * @param hour number
         * @returns JSX.Element
         */
        const hourCell: (_null: null, hour: number) => JSX.Element = (_null, hour: number) => {

            /**
             * 
             * @param minutes number
             * @returns JSX.Element
             */
            const minutesRow: (minutes: number) => JSX.Element = (minutes: number) => {

                /**
                 * timestamp
                 * key
                 */
                const timestamp = mondayStart.plus({ days: index, hours: hour, minutes }).toFormat(timestampFormat)
                const key = hour * 60 + minutes

                return <div key={key} className="calendar-interval" data-timestamp={timestamp}>&nbsp;</div>
            }

            return <div key={hour} className="calendar-hour">{[0, 15, 30, 45].map(minutesRow)}</div>
        }

        return <div className="calendar-day" key={index}>{new Array(24).fill(null).map(hourCell)}</div>
    }


    /**
     * 
     * @param meeting Meeting
     * @returns boolean
     */
    const meetingFilter: (meeting: Meeting) => boolean = (meeting) => {
        /**
         * Meeting appointment
         */
        const appointment = DateTime.fromISO(meeting.appointment)

        return appointment >= mondayStart && appointment <= sundayEnd
    }


    const meetingCell: (meeting: Meeting) => JSX.Element = meeting => {

        /**
         * Meeting appointment
         * Meeting ID
         * Readable appointment
         */
        const appointment = DateTime.fromISO(meeting.appointment)
        const meetingId = meeting.id
        const readableAppointment = appointment.toFormat('dd.MM HH:mm')

        /**
         * 
         * @param participant Contact
         * @returns JSX.Element
         */
        const participantRow: (participant: Contact) => JSX.Element = (participant) => {

            /**
             * Participant ID
             * Last name
             */
            const participantId = participant.id
            const lastName = participant.lastName

            return <div key={participantId}>{lastName}</div>
        }

        return <div className="calendar-event meeting" key={meetingId} data-meeting-id={meetingId}>
            {readableAppointment}
            {meeting.participants.map(participantRow)}
        </div>
    }


    return <div>
        <div className="white-box">
            <button onClick={handlePrevWeek}>&lt;&lt;&lt;</button>
            {readableMondayStart}
            <button onClick={handleCurrentWeek}>NOW</button>
            {readableSundayEnd} 
            <button onClick={handleNextWeek}>&gt;&gt;&gt;</button>
        </div>
        <div className="calendar-week">
            {new Array(7).fill(null).map(dayColumn)}
            {meetingList.filter(meetingFilter).map(meetingCell)}
        </div>
    </div>
}