import { DateTime } from "luxon";
import { useAppSelector, useAppDispatch } from "../hooks";
import { isShownForm as getIsShownCallResultForm, showForm as showCallResultForm } from "../store/callResultFormSlice";
import CallResult from "./CallResult"
import ContactHistoryCall from "./ContactHistoryCall";
import ContactHistoryMeeting from "./ContactHistoryMeeting";
import { useState } from "react";

export default function ContactHistory({ contact }) {
  const dispatch = useAppDispatch()

  const [ start, setStart ] = useState(DateTime.now().plus({weeks: -1}).startOf("week").toISO())
  const [ end, setEnd ] = useState(DateTime.now().endOf("week").toISO())

  const isShownCallResultForm = useAppSelector(getIsShownCallResultForm)
  const contactHistory: any[] = [
    ...[ ...contact.calls.map((call: any) => ({...call, tag: "call", datetime: DateTime.fromISO(call.realizedAt).toISO() })) ],
    ...[ ...contact.meetings.map((meeting: any) => ({...meeting, tag: "meeting", datetime: DateTime.fromISO(meeting.appointment).toISO() })) ],
  ].filter(item => {
    // console.log(start, end, item.datetime, item.datetime >= start, item.dateTime <= end)
    // console.log(item.datetime, end, item.datetime >= start, item.datetime <= end, (item.datetime >= start) && (item.datetime <= end))
    return (item.datetime >= start) && (item.datetime <= end)
  }).sort((a, b) => a.datetime > b.datetime ? 1 : -1);


  return (
    <div className="contact-history">
        {isShownCallResultForm && <CallResult />}
        <h3>Contact history</h3>

        <button className="new-call" onClick={() => dispatch(showCallResultForm(true))}>Call to contact</button>

        <div className="row">
          <input type="date" defaultValue={DateTime.fromISO(start).toISODate() as string} onChange={e => setStart(e.target.value)} />
          <input type="date" defaultValue={DateTime.fromISO(end).toISODate() as string} onChange={e => setEnd(e.target.value)} />
        </div>

        <div className="contact-history-list">
          {contactHistory.map((item: any, index) => <div className={["contact-history-item", item.tag].join(" ")} key={index}>
            {item.tag === "call" && <ContactHistoryCall call={item} />}
            {item.tag === "meeting" && <ContactHistoryMeeting meeting={item} />}
          </div>)}
        </div>
    </div>
  )
}
