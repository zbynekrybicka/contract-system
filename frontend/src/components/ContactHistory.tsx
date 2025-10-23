import { useAppSelector, useAppDispatch } from "../hooks";
import { isShownForm as getIsShownCallResultForm, showForm as showCallResultForm } from "../store/callResultFormSlice";
import CallResult from "./CallResult"

export default function ContactHistory() {
  const dispatch = useAppDispatch()
  // const [ %apiRequest%, { isLoading } ] = use%APIrequest%Mutation()

  // const %storeValue% = useAppSelector(%storeGetter%)
  const isShownCallResultForm = useAppSelector(getIsShownCallResultForm)

  return (
    <div className="contact-history">
        {isShownCallResultForm && <CallResult />}
        <h3>Contact history</h3>

        <button className="new-call" onClick={() => dispatch(showCallResultForm(true))}>Call to contact</button>
    </div>
  )
}
