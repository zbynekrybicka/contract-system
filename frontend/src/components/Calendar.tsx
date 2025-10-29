import { useState } from "react"
import { useGetMeetingQuery } from "../services/api/meetingApi"

import CalendarWeek from "./CalendarWeek"
import CalendarMonth from "./CalendarMonth"
import CalendarDay from "./CalendarDay"
import CalendarAll from "./CalendarAll"


/** 
 * CalendarType enum
 */
const CalendarType = { 
    month: "month", 
    week: "week", 
    day: "day", 
    all: "all" 
} as const;
type CalendarType = typeof CalendarType[keyof typeof CalendarType];

export default function Calendar() {

    /** 
     * GET /meetings
     * 
     * @const meetingList: Meeting[],
     * @const isMeetingListLoading boolean
     */ 
    const { 
        data: meetingList = [], 
        isLoading: isMeetingListLoading 
    } = useGetMeetingQuery({})


    /**
     * Selected calendar type
     * @const type CalendarType
     */
    const [ type, setType ] = useState<CalendarType>(CalendarType.week)

    return <div>
        <h2><div className="inner-content">Calendar</div></h2>
        <div className="inner-content route calendar">

            <div className="white-box">
                <button onClick={() => setType(CalendarType.month)}>Month</button>
                <button onClick={() => setType(CalendarType.week)}>Week</button>
                <button onClick={() => setType(CalendarType.day)}>Day</button>
                <button onClick={() => setType(CalendarType.all)}>All</button>
            </div>

            {isMeetingListLoading ? <img src={"/src/assets/tube-spinner.svg"} height="100px" /> : <>
                {type === CalendarType.month && <CalendarMonth meetingList={meetingList} />}
                {type === CalendarType.week && <CalendarWeek meetingList={meetingList} />}
                {type === CalendarType.day && <CalendarDay meetingList={meetingList} />}
                {type === CalendarType.all && <CalendarAll meetingList={meetingList} />}
            </>}
        </div>
    </div>
}