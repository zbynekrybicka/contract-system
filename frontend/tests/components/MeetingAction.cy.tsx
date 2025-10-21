import { Provider } from 'react-redux'
import { store }  from '../../src/store'
import MeetingAction from '../../src/components/MeetingAction'


describe('MeetingAction.cy.tsx', () => {
  it('%testName%', () => {
    cy.mount(<Provider store={store}><MeetingAction /></Provider>)
  })
})