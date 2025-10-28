import { useState } from "react"
import { useGetMeetingQuery } from "../services/api/meetingApi"

import CalendarWeek from "./CalendarWeek"
import CalendarMonth from "./CalendarMonth"
import CalendarDay from "./CalendarDay"
import CalendarAll from "./CalendarAll"

enum CalendarType {
    month = "month",
    week = "week",
    day = "day",
    all = "all"
}

export default function Calendar() {

    /** GET /meetings */ 
    const { data: meetingList, isLoading: isMeetingListLoading } = useGetMeetingQuery({})

    /** Calendar type */
    const [ type, setType ] = useState<CalendarType>(CalendarType.week)

    return <div>
        <h2>
            <div className="inner-content">Calendar</div>
        </h2>
        <div className="inner-content route calendar">
            <button onClick={() => setType(CalendarType.month)}>Month</button>
            <button onClick={() => setType(CalendarType.week)}>Week</button>
            <button onClick={() => setType(CalendarType.day)}>Day</button>
            <button onClick={() => setType(CalendarType.all)}>All</button>
            <hr/>
            {isMeetingListLoading ? <img src={"/src/assets/tube-spinner.svg"} height="100px" /> : <>
                {type === CalendarType.month && <CalendarMonth meetingList={meetingList} />}
                {type === CalendarType.week && <CalendarWeek meetingList={meetingList} />}
                {type === CalendarType.day && <CalendarDay meetingList={meetingList} />}
                {type === CalendarType.all && <CalendarAll meetingList={meetingList} />}
            </>}
        </div>
    </div>
}