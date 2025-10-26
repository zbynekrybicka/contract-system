import { useAppSelector, useAppDispatch } from "../hooks";
import { isShownForm as getIsShownCallResultForm, showForm as showCallResultForm } from "../store/callResultFormSlice";
import CallResult from "./CallResult"
import ContactHistoryCall from "./ContactHistoryCall";
import ContactHistoryMeeting from "./ContactHistoryMeeting";

export default function ContactHistory({ contact }) {
  const dispatch = useAppDispatch()
  // const [ %apiRequest%, { isLoading } ] = use%APIrequest%Mutation()

  // const %storeValue% = useAppSelector(%storeGetter%)
  const isShownCallResultForm = useAppSelector(getIsShownCallResultForm)
  const contactHistory: any[] = [
    ...[ ...contact.calls.map((call: any) => ({...call, tag: "call", datetime: call.realizedAt })) ],
    ...[ ...contact.meetings.map((meeting: any) => ({...meeting, tag: "meeting", datetime: meeting.appointment })) ],
  ].sort((a, b) => a.datetime > b.datetime ? 1 : -1);

  return (
    <div className="contact-history">
        {isShownCallResultForm && <CallResult />}
        <h3>Contact history</h3>

        <button className="new-call" onClick={() => dispatch(showCallResultForm(true))}>Call to contact</button>

        <div className="contact-history-list">
          {contactHistory.map((item: any) => <div className={["contact-history-item", item.tag].join(" ")}>
            {item.tag === "call" && <ContactHistoryCall call={item} />}
            {item.tag === "meeting" && <ContactHistoryMeeting meeting={item} />}
          </div>)}
        </div>
    </div>
  )
}
