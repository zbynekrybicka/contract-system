import { usePostCallMutation } from "../services/api/callApi";
import { useState, type ChangeEvent, type JSX } from "react";
import { DateTime } from "luxon";
import type { Contact } from "../services/api/contactApi";

type Props = {
    handleShowForm: (show: boolean) => void
    contact: Contact
}

export default function CallResult({ handleShowForm, contact }: Props): JSX.Element {
    

    /**
     * Call purpose
     * Is call successful
     * Type of result
     * Description of result
     * Meeting appointment
     * Place of meeting
     * Appointment of next call
     */
    const [ purpose, setPurpose ] = useState<string>("")
    const [ successful, setSuccessful ] = useState<boolean>(false)
    const [ type, setType ] = useState<string>("")
    const [ description, setDescription ] = useState<string>("")
    const [ meetingAppointment, setMeetingAppointment ] = useState<DateTime | null>(null)
    const [ place, setPlace ] = useState<string>("")
    const [ nextCall, setNextCall ] = useState<DateTime | null>(null)


    const readableMeetingAppointment = meetingAppointment?.toISO() || undefined
    const readableNextCall = nextCall?.toISO() || undefined


    /**
     * Close form
     * Set purpose
     * Set successful
     * Set type
     * Set description
     * Set meeting appointment
     * Set meeting place
     * Set next call
     */
    const handleCloseForm: () => void = () => handleShowForm(false)
    const handleSetPurpose: (event: ChangeEvent<HTMLTextAreaElement>) => void = e => setPurpose(e.target.value)
    const handleSetSuccessful: (event: ChangeEvent<HTMLInputElement>) => void = e => setSuccessful(e.target.checked)
    const handleSetType: (event: ChangeEvent<HTMLSelectElement>) => void = e => setType(e.target.value)
    const handleSetDescription: (event: ChangeEvent<HTMLTextAreaElement>) => void = e => setDescription(e.target.value)
    const handleSetAppointment: (event: ChangeEvent<HTMLInputElement>) => void = e => setMeetingAppointment(DateTime.fromISO(e.target.value))
    const handleSetPlace: (event: ChangeEvent<HTMLInputElement>) => void = e => setPlace(e.target.value)
    const handleSetNextCall: (event: ChangeEvent<HTMLInputElement>) => void = e => setNextCall(DateTime.fromISO(e.target.value))

    /**
     * Form label: successful
     */
    const successfulLabel: string = "Call was successful"


    /**
     * POST /call
     * 
     * @param data CallResultForm
     */
    const [ postCall, { isLoading }] = usePostCallMutation()
    const handleSaveCallResult = () => postCall({
        receiver: contact,
        purpose,
        successful,
        type,
        description,
        meetingAppointment: meetingAppointment?.toISO() || null,
        place,
        nextCall: nextCall?.toISO() || null
    }).then(() => handleShowForm(false));


    /**
     * Appointment meeting (part of form)
     * @returns JSX.Element
     */
    const Appointment: () => JSX.Element = () => <>
        <label>Meeting Appointment <input type="datetime-local" name="meeting-appointment" defaultValue={readableMeetingAppointment} onChange={handleSetAppointment} /></label>
        <label>Meeting Place <input type="text" name="place" defaultValue={place} onChange={handleSetPlace} /></label>
    </>


    /**
     * Fulfill Cal Result (part of form)
     * @returns JSX.Element
     */
    const CallResultDetail: () => JSX.Element = () => <>
        <label>
            <select name="type" defaultValue={type} onChange={handleSetType}>
                <option></option>
                <option value="meeting">Meeting</option>
                <option value="rejected">Rejected</option>
                <option value="postponed">Postponed until later</option>
            </select>
        </label>

        <label>Final Description <textarea name="description" defaultValue={description} onChange={handleSetDescription}></textarea></label>
        {type === "meeting" && <Appointment />}
    </>

  return (
    <div className="dialog-background">
        <div className="dialog call-result">
            <div className="header">Call Result <button onClick={handleCloseForm}>X</button></div>

            <label>Call purpose <textarea name="purpose" defaultValue={purpose} onChange={handleSetPurpose}></textarea></label>
            <label><div className="row"><input type="checkbox" name="successful" defaultChecked={successful} onChange={handleSetSuccessful} />{successfulLabel}</div></label>
            {successful && <CallResultDetail />}
            <label>Call later <input type="datetime-local" name="next-call" defaultValue={readableNextCall} onChange={handleSetNextCall} /></label>            

            <div className="footer">
                {isLoading ? <img src={"/src/assets/tube-spinner.svg"} height="50px" /> : <button className="save-result" onClick={handleSaveCallResult}>Save Call Result</button>}
            </div>
        </div>
    </div>
  )
}
