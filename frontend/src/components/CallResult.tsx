import { useParams } from "react-router-dom";
import { useAppSelector, useAppDispatch } from "../hooks";
import { usePostCallMutation } from "../services/api/callApi";
import { getDescription, getMeetingAppointment, getNextCall, getPlace, getPurpose, getsuccessful, getType, setDescription, setMeetingAppointment, setNextCall, setPlace, setPurpose, setSuccessful, setType, showForm, type CallResultForm } from "../store/callResultFormSlice";

export default function CallResult() {
  const { id } = useParams()
  const dispatch = useAppDispatch()
  const [ postCall, { isLoading }] = usePostCallMutation()

  const purpose = useAppSelector(getPurpose)
  const successful = useAppSelector(getsuccessful)
  const type = useAppSelector(getType)
  const description = useAppSelector(getDescription)
  const meetingAppointment = useAppSelector(getMeetingAppointment)
  const place = useAppSelector(getPlace)
  const nextCall = useAppSelector(getNextCall)

  const handleSaveCallResult = () => postCall({
    contact_id: parseInt(id || ""),
    purpose,
    successful,
    type,
    description,
    meetingAppointment,
    place,
    nextCall,
  } as CallResultForm).then((result) => {
    dispatch(showForm(false))
  });

  return (
    <div className="dialog-background">
        <div className="dialog call-result">
            <div className="header">
                Call Result
                <button onClick={() => dispatch(showForm(false))}>X</button>
            </div>
            <label>
                Call purpose
                <textarea name="purpose" defaultValue={purpose} onChange={e => dispatch(setPurpose(e.target.value))}></textarea>
            </label>
            <div className="footer">
                <button className="call-begin">Begin call</button>
            </div>
            <label>
                <div className="row">
                    <input type="checkbox" name="successful" defaultChecked={successful} onChange={e => dispatch(setSuccessful(e.target.checked))} /> Call was successful
                </div>
            </label>
            <label>
                <select name="type" defaultValue={type} onChange={e => dispatch(setType(e.target.value))}>
                    <option></option>
                    <option value="meeting">Meeting</option>
                    <option value="rejected">Rejected</option>
                    <option value="postponed">Postponed until later</option>
                </select>
            </label>
            <label>
                Final Description
                <textarea name="description" defaultValue={description} onChange={e => dispatch(setDescription(e.target.value))}></textarea>
            </label>
            <label>
                Meeting Appointment
                <input type="datetime-local" name="meeting-appointment" defaultValue={meetingAppointment} onChange={e => dispatch(setMeetingAppointment(e.target.value))} />
            </label>
            <label>
                Meeting Place
                <input type="text" name="place" defaultValue={place} onChange={e => dispatch(setPlace(e.target.value))} />
            </label>
            <label>
                Call later
                <input type="datetime-local" name="next-call" defaultValue={nextCall} onChange={e => dispatch(setNextCall(e.target.value))} />
            </label>
            <div className="footer">
                {isLoading ? <img src={"/src/assets/tube-spinner.svg"} height="50px" /> : <button className="save-result" onClick={handleSaveCallResult}>Save Call Result</button>}
            </div>
        </div>
    </div>
  )
}
