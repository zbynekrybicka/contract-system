import { DateTime } from "luxon";
import ContactHistoryCall from "./ContactHistoryCall";
import ContactHistoryMeeting from "./ContactHistoryMeeting";
import { useState, type ChangeEvent, type JSX } from "react";
import type { Contact } from "../services/api/contactApi";
import type { Call } from "../services/api/callApi";
import type { Meeting } from "../services/api/meetingApi";

type Props = {
  contact: Contact
}

type ContactHistoryItem = {
  tag: string;
  datetime: DateTime;
  item: Call | Meeting;
}

export default function ContactHistory({ contact }: Props): JSX.Element {

  /**
   * Start of interval
   * End of interval
   */
  const [ start, setStart ] = useState<DateTime>(DateTime.now().plus({weeks: -1}).startOf("week"))
  const [ end, setEnd ] = useState<DateTime>(DateTime.now().endOf("week"))


  /**
   * Readable Start of interval
   * Readable End of interval
   */
  const readableStart = start.toISODate() || undefined
  const readableEnd = end.toISODate() || undefined


  /**
   * Set Start
   * Set End
   */
  const handleSetStart: (event: ChangeEvent<HTMLInputElement>) => void = e => setStart(DateTime.fromISO(e.target.value).startOf("day"))
  const handleSetEnd: (event: ChangeEvent<HTMLInputElement>) => void = e => setEnd(DateTime.fromISO(e.target.value).endOf("day"))


  /**
   * @param call Call
   * @returns ContactHistoryItem
   */
  const encapsulateCall: (call: Call) => ContactHistoryItem = (call: Call) => ({
    tag: "call", 
    datetime: DateTime.fromISO(call.realizedAt),
    item: call
  })


  /**
   * @param meeting Meeting
   * @returns ContactHistoryItem
   */
  const encapsulateMeeting: (meeting: Meeting) => ContactHistoryItem = (meeting: Meeting) => ({
    tag: "meeting", 
    datetime: DateTime.fromISO(meeting.appointment),
    item: meeting
  })


  /**
   * @param item ContactHistoryItem
   * @returns boolean
   */
  const contactHistoryFilter: (contactHistoryItem: ContactHistoryItem) => boolean = item => {
    // console.log(start, end, item.datetime, item.datetime >= start, item.datetime <= end)
    return item.datetime >= start && item.datetime <= end
  }


  /**
   * @param a ContactHistoryItem
   * @param b ContactHistoryItem
   * @returns number
   */
  const contactHistorySort: (item1: ContactHistoryItem, item2: ContactHistoryItem) => number = (a, b) => a.datetime > b.datetime ? 1 : -1


  /**
   * @param item ContactHistoryItem
   * @param index number
   * @returns JSX.Element
   */
  const contactHistoryItem: (item: ContactHistoryItem, index: number) => JSX.Element = (item, index) => {

    /**
     * ClassName
     * Is Call
     * IS Meeting
     */
    const className: string = ["row contact-history-item", item.tag].join(" ")
    const isCall = item.tag === "call"
    const isMeeting = item.tag === "meeting"

    return <div className={className} key={index}>
      {isCall && <ContactHistoryCall call={item.item as Call} />}
      {isMeeting && <ContactHistoryMeeting meeting={item.item as Meeting} />}
    </div>
  }


  /**
   * Contact History List
   */
  const contactHistory: JSX.Element = <>{[ 
    ...contact.calls.map(encapsulateCall), 
    ...contact.meetings.map(encapsulateMeeting) 
  ].filter(contactHistoryFilter).sort(contactHistorySort).map(contactHistoryItem)}</>


  return (
    <div className="contact-history">
        <div className="white-box">
          <h3>Contact history</h3>
          <div className="row">
            <input type="date" defaultValue={readableStart} onChange={handleSetStart} />
            <input type="date" defaultValue={readableEnd} onChange={handleSetEnd} />
          </div>
          <div className="contact-history-list table">
            <div className="row header">
              <div></div>
              <div>Appointment</div>
              <div>Detail</div>
            </div>
            {contactHistory}
          </div>
        </div>
    </div>
  )
}
