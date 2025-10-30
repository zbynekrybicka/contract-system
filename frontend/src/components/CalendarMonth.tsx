import { DateTime } from "luxon"
import { useEffect, useState, type JSX } from "react"
import type { Meeting } from "../services/api/meetingApi"
import { distributeAppointments } from "../helpers/distributeAppointments"
import type { Contact } from "../services/api/contactApi"

type Props = {
    meetingList: Meeting[]
}

export default function CalendarMonth({ meetingList }: Props): JSX.Element
{
    /**
     * Selected month (0 = current, negative = previous, positive = next)
     */
    const [ month, setMonth ] = useState(0)


    /**
     * First day of selected interval
     * Last day of selected interval
     * Count of weeks (usually 6, sometimes 5)
     * Timestamp Format
     * Handle previous month
     * Handle next month
     * Handle current month
     * Readable First Day
     * Readable Last Day
     */
    const firstDay: DateTime = DateTime.now().startOf("month").plus({ months: month }).startOf("week")
    const lastDay: DateTime = firstDay.plus({ months: 1 }).endOf("week")
    const countOfWeeks: number = Math.floor((lastDay.toMillis() - firstDay.toMillis()) / 1000 / 3600 / 24 / 7 )
    const timestampFormat: string = "yyyy-MM-dd"
    const handlePrevMonth: () => void = () => setMonth(month - 1)
    const handleNextMonth: () => void = () => setMonth(month + 1)
    const handleCurrentMonth: () => void = () => setMonth(0)
    const readableFirstDay: string = firstDay.toFormat("dd. MM.")
    const readableLastDay: string = lastDay.toFormat("dd. MM. yyyy")


    /**
     * When day is changed or window resized
     */
    distributeAppointments(meetingList, useEffect, [month], timestampFormat)


    /**
     * Day Cell
     * 
     * @param weekIndex number
     * @return function
     * 
     * @param _null null
     * @param dayIndex number
     * @returns JSX.Element
     */
    function dayCell(weekIndex: number): (_null: null, index: number) => JSX.Element 
    {
        return function(_null, dayIndex: number) 
        {
            /**
             * Timestamp for attach calendar events
             * key
             */
            const timestamp: string | null = firstDay.plus({ weeks: weekIndex, days: dayIndex }).toFormat(timestampFormat) 
            const key = weekIndex + "-" + dayIndex

            return <div key={key} className="calendar-day calendar-interval" data-timestamp={timestamp}>&nbsp;</div>
        }
    }    


    /**
     * Week Row
     * 
     * @param _null null
     * @param weekIndex number
     * @returns JSX.Element
     */
    function weekRow(_null: null, weekIndex: number): JSX.Element 
    {
        return <div className="calendar-week" key={weekIndex}>{new Array(7).fill(null).map(dayCell(weekIndex))}</div>
    }


    /**
     * Meeting filter
     * 
     * @param meeting Meeting
     * @returns boolean
     */
    function meetingFilter(meeting: Meeting): boolean
    {
        
        /**
         * Meeting appoint in string
         */
        const appointment = DateTime.fromISO(meeting.appointment)

        return appointment >= firstDay && appointment <= lastDay
    }


    /**
     * Meeting Participant
     * 
     * @param participant Contact
     * @returns JSX.Element
     */
    function meetingParticipant(participant: Contact): JSX.Element
    { 
        /**
         * Participant ID
         * Last Name
         */
        const participantId = participant.id
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
         * Meeting ID
         * Meeting Appointment
         * Meeting Participants
         */
        const meetingId = meeting.id
        const appointment = DateTime.fromISO(meeting.appointment).toFormat('dd.MM HH:mm')
        const meetingParticipants = meeting.participants.map(meetingParticipant)


        return <div className="calendar-event meeting" key={meetingId} data-meeting-id={meetingId}>{appointment}{meetingParticipants}</div>
    }


    const buttonPrevMonth: JSX.Element = <button onClick={handlePrevMonth}>&lt;&lt;&lt;</button>
    const buttonCurrentMonth: JSX.Element = <button onClick={handleCurrentMonth}>NOW</button>
    const buttonNextMonth: JSX.Element = <button onClick={handleNextMonth}>&gt;&gt;&gt;</button>

    const calendarMonth: JSX.Element = <>{new Array(countOfWeeks).fill(null).map(weekRow)}</>

    return <div>
        <div className="white-box">{buttonPrevMonth} {readableFirstDay} {buttonCurrentMonth} {readableLastDay} {buttonNextMonth}</div>
        <div className="calendar-month">{calendarMonth}</div>
        {meetingList.filter(meetingFilter).map(meetingCell)}
    </div>
}