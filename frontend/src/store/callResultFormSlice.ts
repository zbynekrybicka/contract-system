import { createSlice } from '@reduxjs/toolkit';
import type { Action, RootState } from '.';

export type CallResultForm = {
    isShownForm: boolean;
    contact_id: number;
    purpose: string;
    successful: boolean;
    type: string;
    description: string;
    meetingAppointment: string;
    place: string;
    nextCall: string;
}


const slice = createSlice({
    name: "callResultForm",

    initialState: {
        isShownForm: false,
        contact_id: 0,
        purpose: "",
        successful: false,
        type: "",
        description: "",
        meetingAppointment: "",
        place: "",
        nextCall: ""
    },

    reducers: {

        /**
         * 
         * 
         * @param state CallResultForm
         * @param action Action
         */
        showForm: (state: CallResultForm, action: Action<boolean>) => {
            state.isShownForm = action.payload
        },
        

        /**
         * 
         * 
         * @param state CallResultForm
         * @param action Action
         */
        setPurpose: (state: CallResultForm, action: Action<string>) => {
            state.purpose = action.payload
        },
        

        /**
         * 
         * 
         * @param state CallResultForm
         * @param action Action
         */
        setSuccessful: (state: CallResultForm, action: Action<boolean>) => {
            state.successful = action.payload
        },
        

        /**
         * 
         * 
         * @param state CallResultForm
         * @param action Action
         */
        setType: (state: CallResultForm, action: Action<string>) => {
            state.type = action.payload
        },
        

        /**
         * 
         * 
         * @param state CallResultForm
         * @param action Action
         */
        setDescription: (state: CallResultForm, action: Action<string>) => {
            state.description = action.payload
        },
        

        /**
         * 
         * 
         * @param state CallResultForm
         * @param action Action
         */
        setMeetingAppointment: (state: CallResultForm, action: Action<string>) => {
            state.meetingAppointment = action.payload
        },
        

        /**
         * 
         * 
         * @param state CallResultForm
         * @param action Action
         */
        setPlace: (state: CallResultForm, action: Action<string>) => {
            state.place = action.payload
        },
        

        /**
         * 
         * 
         * @param state CallResultForm
         * @param action Action
         */
        setNextCall: (state: CallResultForm, action: Action<string>) => {
            state.nextCall = action.payload
        },

    }
})

/**
 *
 * 
 * @param state 
 * @returns string
 */
export const getPurpose = (state: RootState): string => state.callResultForm.purpose


/**
 *
 * 
 * @param state 
 * @returns boolean
 */
export const getsuccessful = (state: RootState): boolean => state.callResultForm.successful


/**
 *
 * 
 * @param state 
 * @returns string
 */
export const getType = (state: RootState): string => state.callResultForm.type


/**
 *
 * 
 * @param state 
 * @returns string
 */
export const getDescription = (state: RootState): string => state.callResultForm.description


/**
 *
 * 
 * @param state 
 * @returns string
 */
export const getMeetingAppointment = (state: RootState): string => state.callResultForm.meetingAppointment


/**
 *
 * 
 * @param state 
 * @returns string
 */
export const getPlace = (state: RootState): string => state.callResultForm.place


/**
 *
 * 
 * @param state 
 * @returns string
 */
export const getNextCall = (state: RootState): string => state.callResultForm.nextCall


/**
 *
 * 
 * @param state 
 * @returns boolean
 */
export const isShownForm = (state: RootState): boolean => state.callResultForm.isShownForm

export default slice.reducer
export const { showForm, setPurpose, setSuccessful, setType, setDescription, setMeetingAppointment, setPlace, setNextCall } = slice.actions