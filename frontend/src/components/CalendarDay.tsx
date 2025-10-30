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
     * Timestamp Format
     */
    const [ day, setDay ] = useState<DateTime>(DateTime.now().startOf("day"))
    const dayDefaultValue: string | undefined = day.toISODate() || undefined
    const handleSelectDay: (event: ChangeEvent<HTMLInputElement>) => void = e => setDay(DateTime.fromISO(e.target.value).startOf("day"))
    const timestampFormat: string = "yyyy-MM-dd-HH-mm"


    /**
     * When day is changed or window resized
     */
    distributeAppointments(meetingList, useEffect, [day], timestampFormat)


    /**
     * Meeting Filter
     * 
     * @param meeting Meeting
     * @returns boolean
     */
    function meetingFilter(meeting: Meeting): boolean
    {
        /**
         * meeting appointment
         */
        const appointment = DateTime.fromISO(meeting.appointment).toISODate()

        return appointment === day.toISODate()
    }


    /**
     * Participant element
     * 
     * @param participant Contact
     * @return JSX.Element
     */
    function participantElement(participant: Contact): JSX.Element
    {
        /**
         * Participant ID
         * Participant last name
         */
        const participantId = participant.id
        const lastName = participant.lastName


        return <div key={participantId}>{lastName}</div>
    }    


    /**
     * Meeting Cell
     * 
     * @param meeting Meeting
     * @returns JSX.Element
     */
    function meetingCell(meeting: Meeting): JSX.Element
    {

        /**
         * Meeting appointment
         * Meeting ID
         * Readable appointment
         */
        const appointment = DateTime.fromISO(meeting.appointment)
        const meetingId: number = meeting.id
        const readableAppointment: string = appointment.toFormat('dd.MM HH:mm')
        const meetingParticipants: JSX.Element[] = meeting.participants.map(participantElement)


        return <div className="calendar-event meeting" key={meetingId} data-meeting-id={meetingId}>{readableAppointment}{meetingParticipants}</div>
    }


    /**
     * Invisible quarter row
     * 
     * @param hour number
     * @returns function
     */
    function minutesRow(hour: number): (minutes: number) => JSX.Element
    {
        /**
         * @param minutes number
         * @returns JSX.Element
         */
        return function(minutes: number): JSX.Element
        {
            /**
             * Calendar time
             * timestamp for attach event
             * key
             */
            const calendarTime = day.plus({ hours: hour, minutes })
            const timestamp: string = calendarTime.toFormat(timestampFormat)
            const key = hour * 60 + minutes


            return <div key={key} className="calendar-interval" data-timestamp={timestamp}>&nbsp;</div>
        }
    }    


    /**
     * Hour Cell
     * 
     * @param _null undefined
     * @param hour number
     * @returns JSX.Element
     */
    function hourCell(_null: any, hour: number): JSX.Element
    {
        /**
         * Minute Row
         */
        const minuteRow: JSX.Element[] = [0, 15, 30, 45].map(minutesRow(hour))


        return <div key={hour} className="calendar-hour">{minuteRow}</div>
    }


    /**
     * Input Select Date
     * Hour Cells
     */
    const inputSelectDate: JSX.Element = <input type="date" defaultValue={dayDefaultValue} onChange={handleSelectDay} />
    const hourCells: JSX.Element[] = new Array(24).fill(null).map(hourCell)


    return <div>
        <div className="white-box">{inputSelectDate}</div>
        <div className="calendar-day">{hourCells}</div>
        {meetingList.filter(meetingFilter).map(meetingCell)}
    </div>
}