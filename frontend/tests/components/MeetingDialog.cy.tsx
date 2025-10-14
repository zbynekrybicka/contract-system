import { Provider } from 'react-redux'
import { store }  from '../../src/store'
import MeetingDialog from '../../src/components/MeetingDialog'


describe('MeetingDialog.cy.tsx', () => {
  it('%testName%', () => {
    cy.mount(<Provider store={store}><MeetingDialog /></Provider>)
  })
})